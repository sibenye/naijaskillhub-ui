<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Account\ProfileService;
use App\Services\StatesService;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    /**
     *
     * @var ProfileService
     */
    private $profileService;

    /**
     *
     * @var StatesService
     */
    private $statesService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProfileService $profileService, StatesService $statesService)
    {
        $this->profileService = $profileService;
        $this->statesService = $statesService;
        $this->middleware('web');
        $this->middleware('auth');
        $this->middleware('ajax', [
                'except' => 'show'
        ]);
    }

    /**
     * Show the account page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $attributes = $this->profileService->getProfileAttributes();
        $stateList = $this->statesService->getListOfNigerianStates();

        $viewBag = [
                'attributes' => $attributes,
                'stateList' => $stateList
        ];
        return view('account.dashboard', [
                'viewBag' => $viewBag
        ]);
    }

    /**
     * Save User Profile.
     * This should only be called using Ajax.
     * It returns json and not a view.
     */
    public function saveProfile(Request $request)
    {
        /*
         * if ($request->isXmlHttpRequest()) {
         *
         * }
         */
        $userProfile = $request->all();
        $response = $this->profileService->saveUserProfile($userProfile);
        return $response;
    }

    public function saveProfileImage(Request $request)
    {
        $image = $request->getContent();
        $contentType = $request->header('Content-Type');

        $response = $this->profileService->saveUserProfileImage($image, $contentType);
        return $response;
    }

    private function returnResponse($response)
    {
        if (array_key_exists('error', $response)) {
            return response()->json(
                    [
                            'status' => 'error',
                            'message' => $response ['error'],
                            'response' => NULL
                    ], 400);
        } else {
            return response()->json(
                    [
                            'status' => 'success',
                            'message' => NULL,
                            'response' => $response
                    ], 200);
        }
    }
}
