<?php
namespace App\Services\Auth;

use Illuminate\Contracts\Auth\UserProvider;
use App\Services\ApiWrapper\ApiService;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Utilities\HttpClient;

class ApiAuthUserProvider implements UserProvider
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

    /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Auth\UserProvider::retrieveById()
     */
    public function retrieveById($identifier)
    {
        return $this->apiService->getUserModelById($identifier);
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Auth\UserProvider::retrieveByToken()
     */
    public function retrieveByToken($identifier, $token)
    {
        // TODO: Auto-generated method stub
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Auth\UserProvider::updateRememberToken()
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Auto-generated method stub
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Auth\UserProvider::retrieveByCredentials()
     */
    public function retrieveByCredentials(array $credentials)
    {
        return $this->apiService->getUserModelByEmailAddress($credentials ['email']);
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Auth\UserProvider::validateCredentials()
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $userResponse = $this->apiService->authenticateUserCredentials($credentials ['email'],
                $credentials ['password']);

        if ($userResponse) {
            $userId = $userResponse ['userId'];
            if ($userId == $user->getAuthIdentifier()) {
                session(
                        [
                                'nsh_authToken' => $userResponse ['authToken']
                        ]);
                return true;
            }
        }

        return false;
    }

    public function registerUser($registerData)
    {
        $response = $this->apiService->registerUser($registerData ['email'],
                $registerData ['password'], $registerData ['firstName'], $registerData ['lastName'],
                $registerData ['accountType'], $registerData ['credentialType']);

        if ($response && !array_key_exists('error', $response)) {
            $userId = $response ['userId'];
            session(
                    [
                            'nsh_authToken' => $response ['authToken']
                    ]);
            return $this->retrieveById($userId);
        }
        return null;
    }
}