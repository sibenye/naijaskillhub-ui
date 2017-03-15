<?php
namespace App\Services;

use App\Services\ApiWrapper\ApiService;

class AuthService
{
    private $apiService;

    /**
     * AuthService constructor
     *
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function authenticate($emailAddress, $password)
    {
        $response = $this->apiService->standardLogin($emailAddress, $password);
        session([
                'authToken' => $response ['authToken']
        ]);
        return $response;
    }
}