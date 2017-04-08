<?php
namespace App\Services\Account;

use App\Services\ApiWrapper\ApiService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;

class PortfolioService
{
    /**
     *
     * @var ApiService
     */
    private $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getUserImagePortfolio($imageId = NULL)
    {
        $userId = Auth::user()->getAuthIdentifier();

        $response = $this->apiService->getUserImagePortfolio($userId);

        if (array_key_exists('error', $response)) {
            return $response;
        }

        $portfolioImages = $this->mapPortfolioImageResponse($response ['images']);

        if (!empty($imageId)) {
            $found = false;
            $imageRequested = [ ];
            foreach ($portfolioImages as $portfolioImage) {
                if ($portfolioImage ['imageId'] == $imageId) {
                    $found = true;
                    $imageRequested [0] = $portfolioImage;
                    break;
                }
            }

            if (!$found) {
                abort(404);
            }

            return $imageRequested;
        }

        return $portfolioImages;
    }

    public function getUserPortfolio()
    {
        $userId = Auth::user()->getAuthIdentifier();

        $response = $this->apiService->getUserPortfolio($userId);

        if (array_key_exists('error', $response)) {
            return $response;
        }

        $portfolio = [ ];

        $portfolio ['images'] = $this->mapPortfolioImageResponse($response ['images']);
        $portfolio ['videos'] = $this->mapPortfolioVideoResponse($response ['videos']);
        $portfolio ['audios'] = $this->mapPortfolioAudioResponse($response ['audios']);
        $portfolio ['credits'] = $this->mapPortfolioCreditResponse($response ['credits']);

        return $portfolio;
    }

    /**
     *
     * @param string $image
     * @param string $caption
     * @param string $contentType
     * @return string[]|unknown[]|mixed[]
     */
    public function saveUserPortfolioImage(UploadedFile $image, $caption)
    {
        $response = [ ];

        $contentType = 'image/' . $image->extension();
        Log::info('IMAGE EXTENSION: ' . $image->extension());

        if (empty($caption)) {
            $caption = empty($image->getClientOriginalName()) ? '' : substr(
                    $image->getClientOriginalName(), 0, 40);
        }

        $authToken = session('nsh_authToken');
        // then save the image
        $imageContent = file_get_contents($image->getPathname());
        $saveImageResponse = $this->apiService->uploadUserPortfolioImage($imageContent,
                $contentType, $authToken, $caption);
        if (array_key_exists('error', $saveImageResponse)) {
            return $saveImageResponse;
        }

        $fileSource = env('STATIC_FILES_LOCATION_URL') . $saveImageResponse ['filePath'];

        $response ['fileSrc'] = $fileSource;

        return $response;
    }

    /**
     *
     * @param int $imageId
     * @param string $caption
     * @return array
     */
    public function updateUserPorfolioImage($imageId, $caption)
    {
        $metadataResponse = $this->savePortfolioImageMetadata($caption, $imageId);

        if (array_key_exists('error', $metadataResponse)) {
            return $metadataResponse;
        }

        $response = [ ];
        $response ['imageId'] = $metadataResponse ['imageId'];
        $response ['fileSrc'] = env('STATIC_FILES_LOCATION_URL') . $metadataResponse ['filePath'];
        $response ['caption'] = $metadataResponse ['caption'];

        return $response;
    }

    private function savePortfolioImageMetadata($caption, $imageId)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $authToken = session('nsh_authToken');

        $metadataResponse = $this->apiService->savePortfolioImageMetaData($userId, $authToken,
                $caption, $imageId);

        return $metadataResponse;
    }

    private function mapPortfolioImageResponse($images)
    {
        $imagesResponse = [ ];

        foreach ($images as $key => $value) {
            $imagesResponse [$key] ['imageId'] = $value ['imageId'];
            $imagesResponse [$key] ['caption'] = $value ['caption'];
            $imagesResponse [$key] ['fileSrc'] = env('STATIC_FILES_LOCATION_URL') .
                     $value ['filePath'];
        }

        return $imagesResponse;
    }

    private function mapPortfolioVideoResponse($videos)
    {
        $videosResponse = [ ];

        foreach ($videos as $key => $value) {
            $videosResponse [$key] ['videoId'] = $value ['videoId'];
            $videosResponse [$key] ['caption'] = $value ['caption'];
            $videosResponse [$key] ['videoUrl'] = $value ['videoUrl'];
        }

        $videosResponse;
    }

    private function mapPortfolioAudioResponse($audios)
    {
        $audiosResponse = [ ];

        foreach ($audios as $key => $value) {
            $audiosResponse [$key] ['audioId'] = $value ['audioId'];
            $audiosResponse [$key] ['caption'] = $value ['caption'];
            $audiosResponse [$key] ['fileSrc'] = env('STATIC_FILES_LOCATION_URL') .
                     $value ['filePath'];
        }

        $audiosResponse;
    }

    private function mapPortfolioCreditResponse($credits)
    {
        $creditsResponse = [ ];

        foreach ($credits as $key => $value) {
            $creditsResponse [$key] ['creditId'] = $value ['creditId'];
            $creditsResponse [$key] ['caption'] = $value ['caption'];
            $creditsResponse [$key] ['creditType'] = $value ['creditType'];
            $creditsResponse [$key] ['creditTypeId'] = $value ['creditTypeId'];
            $creditsResponse [$key] ['year'] = $value ['year'];
        }

        $creditsResponse;
    }
}
