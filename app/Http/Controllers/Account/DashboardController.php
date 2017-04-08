<?php
namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Services\Account\ProfileService;
use App\Services\StatesService;
use App\Services\Account\PortfolioService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioImageAddRequest;
use App\Http\Requests\PortfolioImageEditRequest;

class DashboardController extends Controller
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
     *
     * @var PortfolioService
     */
    private $portfolioService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProfileService $profileService, StatesService $statesService,
            PortfolioService $portfolioService)
    {
        $this->profileService = $profileService;
        $this->statesService = $statesService;
        $this->portfolioService = $portfolioService;

        $this->middleware('web');
        $this->middleware('auth');
        $this->middleware('ajax',
                [
                        'except' => [
                                'show',
                                'addPortfolioImage',
                                'editPortfolioImage',
                                'savePortfolioImage',
                                'updatePortfolioImage'
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
        $portfolio = $this->portfolioService->getUserPortfolio();

        $viewBag = [
                'attributes' => $attributes,
                'stateList' => $stateList,
                'portfolio' => $portfolio
        ];
        return view('account.dashboard', [
                'viewBag' => $viewBag
        ]);
    }

    /**
     * Show new portfolio image page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addPortfolioImage()
    {
        return view('account.portfolio_image_add', [
                'viewBag' => [ ]
        ]);
    }

    /**
     * Show edit portfolio image page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editPortfolioImage($imageId)
    {
        $portfolioImage = $this->portfolioService->getUserImagePortfolio($imageId);
        return view('account.portfolio_image_edit',
                [
                        'viewBag' => $portfolioImage [0]
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

    /**
     * Save portfolio image.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function savePortfolioImage(PortfolioImageAddRequest $request)
    {
        $image = $request->file('image', NULL);
        $caption = $request->input('caption');

        $response = $this->portfolioService->saveUserPortfolioImage($image, $caption);

        if (array_key_exists('error', $response)) {

            $request->session()->flash('requestError', $response ['error']);
            return back()->withInput();
        }

        return redirect()->route('account');
    }

    /**
     * Update Portfolio image.
     *
     * @param PortfolioImageEditRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function updatePortfolioImage(PortfolioImageEditRequest $request)
    {
        $imageId = $request->input('imageId');
        $caption = $request->input('caption');

        $response = $this->portfolioService->updateUserPorfolioImage($imageId, $caption);

        if (array_key_exists('error', $response)) {

            return back()->withInput();
        }

        return redirect()->route('account');
    }
}
