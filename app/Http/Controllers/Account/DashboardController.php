<?php
namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Services\Account\ProfileService;
use App\Services\StatesService;
use App\Services\Account\PortfolioService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioImageAddRequest;
use App\Http\Requests\PortfolioImageEditRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PortfolioAudioAddRequest;
use App\Http\Requests\PortfolioAudioEditRequest;
use Illuminate\Support\Facades\Auth;

/**
 *
 * @author silver.ibenye
 *
 */
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
     * Create a new dashboard controller instance.
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
    }

    /**
     * Show the account page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show()
    {
        $user = Auth::user();
        $viewBag = [
                'user' => [
                        'email' => $user->getEmailAttribute(),
                        'isActive' => $user->getIsActiveAttribute(),
                        'portfolioSummary' => $user->getPortfolioAttribute(),
                        'accountType' => $user->getAccountTypesAttribute() [0],
                        'credentialTypes' => $user->getCredentialTypesAttribute()
                ]
        ];
        return view('account.dashboard', [
                'viewBag' => $viewBag
        ]);
    }
}
