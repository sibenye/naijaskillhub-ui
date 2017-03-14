<?php
namespace App\Services\Api;

use App\Utilities\HttpClient;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\RequestException;

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
        $headerOptions ['NSH-API-KEY'] = $this->apiKey;
        $clientOptions = [ ];
        $clientOptions ['headers'] = $headerOptions;

        $responseArray = [ ];

        try {
            $response = $this->httpClient->makeRequest($endpoint, $params, $method, $clientOptions,
                    $isJsonData);

            $responseArray = $this->convertToAssociativeArray($response->getBody()) ['response'];
        } catch ( ClientException $ex ) {
            $response = $this->convertToAssociativeArray($ex->getResponse()
                ->getBody());

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