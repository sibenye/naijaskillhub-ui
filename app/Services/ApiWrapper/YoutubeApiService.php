<?php
namespace App\Services\ApiWrapper;

use App\Utilities\HttpClient;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\RequestException;

class YoutubeApiService
{
    /**
     * API Key.
     *
     * @var string
     */
    private $apiKey;

    /**
     *
     * @var HttpClient
     */
    private $httpClient;

    /**
     * API Service Constructor
     *
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = env('YOUTUBE_API_KEY');
    }

    public function getVideoData($videoId)
    {
        $params = [
                'key' => $this->apiKey,
                'part' => 'id,snippet',
                'id' => $videoId
        ];
        $endpoint = 'videos';

        $response = $this->sendRequest($endpoint, $params);

        return $response;
    }

    private function sendRequest($endpoint, $params, $method = 'GET', array $headerOptions = [],
            $isJsonData = false, $isMultipart = false)
    {
        $clientOptions = [ ];
        $clientOptions ['headers'] = $headerOptions;

        $responseArray = [ ];

        try {
            $response = $this->httpClient->makeRequest($endpoint, $params, $method, $clientOptions,
                    $isJsonData, $isMultipart);
            Log::info('YOUTUBE RESPONSE: ' . $response->getBody());

            $responseArray = convertToAssociativeArray($response->getBody());
        } catch ( ClientException $ex ) {
            $errorMessage = $ex->getMessage();
            Log::error($errorMessage);
        } catch ( ServerException $ex ) {
            $errorMessage = 'Internal Server Error In Youtube API Server: ' . $ex->getMessage();
            Log::error($errorMessage);
        } catch ( RequestException $ex ) {
            $errorMessage = 'Error Recieved From Youtube API Request: ' . $ex->getMessage();
            Log::error($errorMessage);
        }

        return $responseArray;
    }
}