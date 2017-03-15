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

    public function __construct()
    {
        $this->apiService = new ApiService(new HttpClient(env('NSH_API_BASE_URL')));
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
}