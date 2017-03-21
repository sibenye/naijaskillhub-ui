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
        Log::info("REQUEST HEADER: " . json_encode($request->headers->all()));
        if ($request->isXmlHttpRequest()) {
            Log::info("IS JSON REQUEST");
        }
        Log::info("REQUEST: " . $request->input('firstName', NULL));
        $userProfile = $request->all();
        $response = $this->profileService->saveUserProfile($userProfile);
        $httpStatus = 200;

        if (array_key_exists('error', $response)) {
            $httpStatus = 400;
        }
        return response()->json([
                'status' => 'success'
        ], $httpStatus);
    }
}