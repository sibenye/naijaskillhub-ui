<?php
namespace App\Services\Account;

use App\Services\ApiWrapper\ApiService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Utilities\DropboxClientWrapper;

class ProfileService
{
    /**
     *
     * @var ApiService
     */
    private $apiService;

    /**
     *
     * @var DropboxClientWrapper
     */
    private $dropboxClient;

    public function __construct(ApiService $apiService, DropboxClientWrapper $dropboxClient)
    {
        $this->apiService = $apiService;
        $this->dropboxClient = $dropboxClient;
    }

    public function getProfileAttributes()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $attributeType = 'profile';
        $authToken = session('nsh_authToken');

        $response = $this->apiService->getUserAttributes($userId, $authToken, $attributeType);

        if (array_key_exists('error', $response)) {
            return $response;
        }

        $attributes = $response ['attributes'];

        $profileAttributes = [ ];

        foreach ($attributes as $attribute) {

            if ($attribute ['attributeName'] == 'profileImage') {
                $profileAttributes [$attribute ['attributeName']] = $this->dropboxClient->getFileSource(
                        $attribute ['attributeValue']);
            } else {
                $profileAttributes [$attribute ['attributeName']] = $attribute ['attributeValue'];
            }
        }

        return $profileAttributes;
    }

    public function saveUserProfile($userProfile)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $authToken = session('nsh_authToken');

        $response = $this->apiService->saveUserAttributeValues($userId, $authToken, $userProfile);

        if (!empty($response) && array_key_exists('error', $response)) {
            return $response;
        }

        return [ ];
    }

    public function saveUserProfileImage($image, $contentType)
    {
        $authToken = session('nsh_authToken');

        $response = $this->apiService->uploadUserProfileImage($image, $contentType, $authToken);

        if (!empty($response) && array_key_exists('error', $response)) {
            return $response;
        }

        $fileSource = env('STATIC_FILES_LOCATION_URL') . $response ['filePath'];

        return [
                'fileSrc' => $fileSource
        ];
    }
}
