<?php
namespace App\Services\Account;

use App\Services\ApiWrapper\ApiService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileService
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
            $profileAttributes [$attribute ['attributeName']] = $attribute ['attributeValue'];
        }

        return $profileAttributes;
    }

    public function saveUserProfile($userProfile)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $authToken = session('nsh_authToken');
        Log::info('PROFILE POST REQUEST: ' . json_encode($userProfile));

        $response = $this->apiService->saveUserAttributeValues($userId, $authToken, $userProfile);

        if (!empty($response) && array_key_exists('error', $response)) {
            return $response;
        }

        return [
                'status' => 'success'
        ];
    }
}
