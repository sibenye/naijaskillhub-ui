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
use Illuminate\Support\Facades\Log;

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

    /**
     * Calls API register endpoint.
     *
     * @param string $emailAddress
     * @param string $password
     * @param string $firstName
     * @param string $lastName
     * @param string $accountType
     * @param string $credentialType
     */
    public function registerUser($emailAddress, $password, $firstName, $lastName, $accountType,
            $credentialType = 'standard')
    {
        $params = [ ];
        $params ['emailAddress'] = $emailAddress;
        $params ['password'] = $password;
        $params ['credentialType'] = $credentialType;
        $params ['firstName'] = $firstName;
        $params ['lastName'] = $lastName;
        $params ['accountType'] = $accountType;

        return $this->sendRequest('register', $params, 'POST', [ ], true);
    }

    /**
     *
     * @param int $id
     * @return NULL|\App\Models\User
     */
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

    /**
     *
     * @param string $email
     * @return NULL|\App\Models\User
     */
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

    /**
     * Get User Attribute Values.
     *
     * @param int $id
     * @param string $authToken
     * @param string $attributeType
     * @param array $attributeNames
     */
    public function getUserAttributes($id, $authToken, $attributeType = NULL, $attributeNames = [])
    {
        $params = [ ];
        $endpoint = 'users/' . $id . '/attributes';

        if ($attributeType) {
            $params ['attributeType'] = $attributeType;
        }

        if (count($attributeNames) > 0) {
            $params ['attributeNames'] = implode(',', $attributeNames);
        }
        return $this->sendRequest($endpoint, $params, 'GET', $this->buildAuthHeader($authToken));
    }

    /**
     * Save User Attribute Values.
     *
     * @param int $id
     * @param string $authToken
     * @param array $attributeValues
     */
    public function saveUserAttributeValues($id, $authToken, $attributeValues)
    {
        $params = $attributeValues;
        $endpoint = 'users/' . $id . '/attributes';

        return $this->sendRequest($endpoint, $params, 'POST', $this->buildAuthHeader($authToken),
                true);
    }

    /**
     *
     * @param string $image
     * @param string $authToken
     */
    public function uploadUserProfileImage($image, $contentType, $authToken)
    {
        $endpoint = 'upload/profileImage';
        $headerOptions = $this->buildAuthHeader($authToken);

        $params = [
                [
                        'name' => 'file',
                        'contents' => $image
                ],
                [
                        'name' => 'uploadContentType',
                        'contents' => $contentType
                ]
        ];

        return $this->sendRequest($endpoint, $params, 'POST', $headerOptions, false, true);
    }

    /**
     *
     * @param int $userId
     * @return array
     */
    public function getUserPortfolio($userId)
    {
        $endpoint = 'users/' . $userId . '/portfolios';

        return $this->sendRequest($endpoint, [ ], 'GET');
    }

    /**
     *
     * @param int $userId
     * @return array
     */
    public function getUserImagePortfolio($userId)
    {
        $endpoint = 'users/' . $userId . '/portfolios/images';

        return $this->sendRequest($endpoint, [ ], 'GET');
    }

    /**
     *
     * @param string $image
     * @param string $contentType
     * @param string $authToken
     * @param string $location
     */
    public function uploadUserPortfolioImage($image, $contentType, $authToken, $caption)
    {
        $endpoint = 'upload/portfolio/image';
        $headerOptions = $this->buildAuthHeader($authToken);

        $params = [
                [
                        'name' => 'file',
                        'contents' => $image
                ],
                [
                        'name' => 'uploadContentType',
                        'contents' => $contentType
                ],
                [
                        'name' => 'caption',
                        'contents' => $caption
                ]
        ];

        return $this->sendRequest($endpoint, $params, 'POST', $headerOptions, false, true);
    }

    /**
     *
     * @param int $userId
     * @param string $authToken
     * @param string $caption
     * @param string $imageType
     * @param int $imageId
     */
    public function savePortfolioImageMetaData($userId, $authToken, $caption, $imageId)
    {
        $endpoint = '/users/' . $userId . '/portfolios/images';
        $headerOptions = $this->buildAuthHeader($authToken);
        $params = [ ];
        $params ['caption'] = $caption;
        $params ['imageId'] = $imageId;

        return $this->sendRequest($endpoint, $params, 'POST', $headerOptions, true);
    }

    /**
     * Delete a user's portfolio image.
     *
     * @param int $imageId
     * @param int $userId
     * @param string $authToken
     */
    public function deleteUserPortfolioImage($imageId, $userId, $authToken)
    {
        $endpoint = '/users/' . $userId . '/portfolios/images?imageId=' . $imageId;
        $headerOptions = $this->buildAuthHeader($authToken);
        $params = [ ];

        return $this->sendRequest($endpoint, $params, 'DELETE', $headerOptions);
    }

    /**
     * Puts the authToken in a header array and
     * returns the header array.
     *
     * @param string $authToken
     * @return array
     */
    private function buildAuthHeader($authToken)
    {
        $headerOptions = [ ];
        $headerOptions [Config::get('constants.authToken_header_name')] = $authToken;

        return $headerOptions;
    }

    /**
     *
     * @param array $userResponse
     * @return array
     */
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
            $isJsonData = false, $isMultipart = false)
    {
        $headerOptions [Config::get('constants.apiKey_header_name')] = $this->apiKey;
        $clientOptions = [ ];
        $clientOptions ['headers'] = $headerOptions;

        $responseArray = [ ];

        try {
            $response = $this->httpClient->makeRequest($endpoint, $params, $method, $clientOptions,
                    $isJsonData, $isMultipart);

            $responseArray = $this->convertToAssociativeArray($response->getBody()) ['response'];
            Log::info('RESPONSE: ' . $response->getBody());
        } catch ( ClientException $ex ) {
            $response = $this->convertToAssociativeArray(
                    $ex->getResponse()
                        ->getBody());
            // Log::info('CATCH1: ' . $ex->getResponse()->getBody());
            // Log::info('CATCH2: ' . $ex->getRequest()->getUri());
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
            $responseArray ['error'] = 'Internal Server Error In API Server: ' . $ex->getMessage();
            Log::error('ERROR: ' . $ex->getMessage());
        } catch ( RequestException $ex ) {
            $responseArray ['error'] = 'Error Recieved From API Request: ' . $ex->getMessage();
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