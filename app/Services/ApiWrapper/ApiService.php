<?php
namespace App\Services\ApiWrapper;

use App\Utilities\HttpClient;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Auth\AuthenticationException;
use App\Models\User;
use Illuminate\Support\Facades\Config;

class ApiService
{
    /**
     *
     * @var HttpClient
     */
    private $httpClient;

    /**
     * API key
     * @var string
     */
    private $apiKey;

    /**
     * API Service Constructor
     *
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = env('NSH_API_KEY');
    }

    /**
     *
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function authenticateUserCredentials($username, $password)
    {
        $userResponse = $this->standardLogin($username, $password);

        if (array_key_exists('error', $userResponse)) {
            return false;
        } else {
            return $userResponse;
        }
    }

    /**
     *
     * @param string $emailAddress
     * @param string $password
     * @return array
     */
    public function standardLogin($emailAddress, $password)
    {
        $params = [ ];
        $params ['emailAddress'] = $emailAddress;
        $params ['password'] = $password;
        $params ['credentialType'] = 'standard';

        return $this->sendRequest('login', $params, 'POST', [ ], true);
    }

    public function getUserModelById($id)
    {
        $userResponse = $this->getUserById($id);
        $userModel = NULL;

        if (!array_key_exists('error', $userResponse)) {
            $userAttributes = $this->mapAttributes($userResponse);
            $userModel = new User($userAttributes);
        }

        return $userModel;
    }

    public function getUserModelByEmailAddress($email)
    {
        $userResponse = $this->getUserByEmailAddress($email);
        $userModel = NULL;

        if (!array_key_exists('error', $userResponse)) {
            $userAttributes = $this->mapAttributes($userResponse);
            $userModel = new User($userAttributes);
        }

        return $userModel;
    }

    /**
     * Get User by email.
     *
     * @param string $email
     */
    public function getUserByEmailAddress($email)
    {
        return $this->sendRequest('users/byEmail/' . $email, [ ], 'GET');
    }

    /**
     * Get User by id.
     *
     * @param int $id
     */
    public function getUserById($id)
    {
        return $this->sendRequest('users/' . $id, [ ], 'GET');
    }

    public function getUserAttributes($id, $authToken, $attributeType = NULL, $attributeNames = [])
    {
        $headerOptions = [ ];
        $headerOptions [Config::get('constants.authToken_header_name')] = $authToken;
        $params = [ ];
        $endPoint = 'users/' . $id . '/attributes';

        if ($attributeType) {
            $params ['attributeType'] = $attributeType;
        }

        if (count($attributeNames) > 0) {
            $params ['attributeNames'] = implode(',', $attributeNames);
        }
        return $this->sendRequest($endPoint, $params, 'GET', $headerOptions);
    }

    private function mapAttributes($userResponse)
    {
        $userAttributes = [ ];
        $userAttributes ['id'] = $userResponse ['userId'];
        $userAttributes ['isActive'] = $userResponse ['isActive'];
        $userAttributes ['email'] = $userResponse ['emailAddress'];
        $userAttributes ['credentialTypes'] = $userResponse ['credentialTypes'];
        $userAttributes ['accountTypes'] = $userResponse ['accountTypes'];
        $userAttributes ['categories'] = $userResponse ['categories'];

        return $userAttributes;
    }

    /**
     *
     * @param string $endpoint
     * @param array|string|resource $params
     * @param string $method
     * @param array $headerOptions
     * @param boolean $isJsonData
     * @return array
     */
    private function sendRequest($endpoint, $params, $method = 'GET', array $headerOptions = [],
            $isJsonData = false)
    {
        $headerOptions [Config::get('constants.apiKey_header_name')] = $this->apiKey;
        $clientOptions = [ ];
        $clientOptions ['headers'] = $headerOptions;

        $responseArray = [ ];

        try {
            $response = $this->httpClient->makeRequest($endpoint, $params, $method, $clientOptions,
                    $isJsonData);

            $responseArray = $this->convertToAssociativeArray($response->getBody()) ['response'];
        } catch ( ClientException $ex ) {
            $response = $this->convertToAssociativeArray(
                    $ex->getResponse()
                        ->getBody());
            if ($ex->getResponse()->getStatusCode() == 401) {
                if ($response ['code'] == 101) {
                    throw new AuthenticationException();
                } else if ($response ['code'] == 102) {
                    abort('401');
                }
            } else if ($ex->getResponse()->getStatusCode() == 403) {
                abort('403', $response ['message']);
            }

            $responseArray ['error'] = $response ['message'];
        } catch ( ServerException $ex ) {
            $responseArray ['error'] = 'Internal Server Error In API Server';
        } catch ( RequestException $ex ) {
            $responseArray ['error'] = 'Error Recieved From API Request';
        }

        return $responseArray;
    }

    /**
     * Decodes a json object.
     *
     * @param string $string The string to decode.
     *
     * @return associative array.
     * @throws \Exception Response is not a valid JSON string.
     */
    public function convertToAssociativeArray($string)
    {
        $responseArray = json_decode($string, true);

        return $responseArray;
    }
}