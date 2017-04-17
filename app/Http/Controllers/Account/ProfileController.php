<?php
namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Services\Account\ProfileService;
use App\Services\StatesService;
use Illuminate\Http\Request;

/**
 *
 * @author silver.ibenye
 *
 */
class ProfileController extends Controller
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
     * Create a new profile controller instance.
     *
     * @return void
     */
    public function __construct(ProfileService $profileService, StatesService $statesService)
    {
        $this->profileService = $profileService;
        $this->statesService = $statesService;

        $this->middleware('web');
        $this->middleware('auth');
        $this->middleware('ajax',
                [
                        'only' => [
                                'saveProfile',
                                'saveProfileImage'
                        ]
                ]);
    }

    /**
     * Show the account page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show()
    {
        $attributes = $this->profileService->getProfileAttributes();
        $stateList = $this->statesService->getListOfNigerianStates();

        $viewBag = [
                'attributes' => $attributes,
                'stateList' => $stateList
        ];
        return view('account.profile_edit', [
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
        $userProfile = $request->all();
        $response = $this->profileService->saveUserProfile($userProfile);
        return $response;
    }

    /**
     * Save profile image.
     *
     * @param Request $request
     * @return array
     */
    public function saveProfileImage(Request $request)
    {
        $image = $request->getContent();
        $contentType = $request->header('Content-Type');

        $response = $this->profileService->saveUserProfileImage($image, $contentType);
        return $response;
    }
}
