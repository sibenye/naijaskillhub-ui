<?php
namespace App\Services\Account;

use App\Services\ApiWrapper\ApiService;
use Illuminate\Support\Facades\Auth;

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
}