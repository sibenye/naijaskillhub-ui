<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Account\ProfileService;
use App\Services\StatesService;

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
}