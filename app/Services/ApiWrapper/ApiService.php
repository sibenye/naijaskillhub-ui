<?php
namespace App\Services\ApiWrapper;

use App\Mappers\ApiResponseMappers\LoginResponseMapper;
use App\Mappers\ApiResponseMappers\RegisterResponseMapper;
use App\Mappers\ApiResponseMappers\UserResponseMapper;
use App\Models\User;
use App\Utilities\HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use App\Mappers\ApiResponseMappers\AttributesResponseMapper;
use App\Mappers\ApiResponseMappers\PortfoliosResponseMapper;
use App\Mappers\ApiResponseMappers\PortfolioImagesResponseMapper;
use App\Mappers\ApiResponseMappers\PortfolioAudiosResponseMapper;

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
        $loginResponse = $this->standardLogin($username, $password);

        if (array_key_exists('error', $loginResponse)) {
            return false;
        } else {
            $loginResponseMapper = new LoginResponseMapper();
            return $loginResponseMapper->map($loginResponse);
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

        $response = $this->sendRequest('register', $params, 'POST', [ ], true);

        if ($response && !array_key_exists('error', $response)) {
            $registerMapper = new RegisterResponseMapper();
            return $registerMapper->map($response);
        }

        return $response;
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
            $userModel = new User($userResponse);
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
            $userModel = new User($userResponse);
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
        $response = $this->sendRequest('users/byEmail/' . $email, [ ], 'GET');

        if (!array_key_exists('error', $response)) {
            $mappedResponse = $this->mapUserResponse($response);
            return $mappedResponse;
        }

        return $response;
    }

    /**
     * Get User by id.
     *
     * @param int $id
     */
    public function getUserById($id)
    {
        $response = $this->sendRequest('users/' . $id, [ ], 'GET');

        if (!array_key_exists('error', $response)) {
            $mappedResponse = $this->mapUserResponse($response);
            return $mappedResponse;
        }

        return $response;
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
        $response = $this->sendRequest($endpoint, $params, 'GET',
                $this->buildAuthHeader($authToken));

        if (!array_key_exists('error', $response)) {
            $attributesMapper = new AttributesResponseMapper();
            $mappedResponse = $attributesMapper->map($response ['attributes']);
            return $mappedResponse;
        }

        return $response;
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

        $response = $this->sendRequest($endpoint, [ ], 'GET');

        if (!array_key_exists('error', $response)) {
            $portfoliosMapper = new PortfoliosResponseMapper();
            $mappedResponse = $portfoliosMapper->map($response);
            return $mappedResponse;
        }

        return $response;
    }

    /**
     *
     * @param int $userId
     * @return array
     */
    public function getUserImagePortfolio($userId)
    {
        $endpoint = 'users/' . $userId . '/portfolios/images';

        $response = $this->sendRequest($endpoint, [ ], 'GET');

        if (!array_key_exists('error', $response)) {
            $portfoliosMapper = new PortfolioImagesResponseMapper();
            $mappedResponse = $portfoliosMapper->map($response ['images']);
            return $mappedResponse;
        }

        return $response;
    }

    /**
     *
     * @param int $userId
     * @return array
     */
    public function getUserAudioPortfolio($userId)
    {
        $endpoint = 'users/' . $userId . '/portfolios/audios';

        $response = $this->sendRequest($endpoint, [ ], 'GET');

        if (!array_key_exists('error', $response)) {
            $portfoliosMapper = new PortfolioAudiosResponseMapper();
            $mappedResponse = $portfoliosMapper->map($response ['audios']);
            return $mappedResponse;
        }

        return $response;
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
     * @param string $audio
     * @param string $contentType
     * @param string $authToken
     * @param string $location
     */
    public function uploadUserPortfolioAudio($audio, $contentType, $authToken, $caption)
    {
        $endpoint = 'upload/portfolio/audio';
        $headerOptions = $this->buildAuthHeader($authToken);

        $params = [
                [
                        'name' => 'file',
                        'contents' => $audio
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
     *
     * @param int $userId
     * @param string $authToken
     * @param string $caption
     * @param string $imageType
     * @param int $audioId
     */
    public function savePortfolioAudioMetaData($userId, $authToken, $caption, $audioId)
    {
        $endpoint = '/users/' . $userId . '/portfolios/audios';
        $headerOptions = $this->buildAuthHeader($authToken);
        $params = [ ];
        $params ['caption'] = $caption;
        $params ['audioId'] = $audioId;

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
     * Delete a user's portfolio audio.
     *
     * @param int $audioId
     * @param int $userId
     * @param string $authToken
     */
    public function deleteUserPortfolioAudio($audioId, $userId, $authToken)
    {
        $endpoint = '/users/' . $userId . '/portfolios/audios?audioId=' . $audioId;
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
    private function mapUserResponse($userResponse)
    {
        $userMapper = new UserResponseMapper();
        return $userMapper->map($userResponse);
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
            Log::info('REQUEST: ' . $endpoint);
            $response = $this->httpClient->makeRequest($endpoint, $params, $method, $clientOptions,
                    $isJsonData, $isMultipart);

            $responseArray = $this->convertToAssociativeArray($response->getBody()) ['response'];
            Log::info('RESPONSE: ' . $response->getBody());
        } catch ( ClientException $ex ) {
            $response = $this->convertToAssociativeArray(
                    $ex->getResponse()
                        ->getBody());
            Log::info('CATCH1: ' . $ex->getResponse()->getBody());
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