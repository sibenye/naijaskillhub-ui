<?php
namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Services\Account\PortfolioService;
use App\Http\Requests\PortfolioImageAddRequest;
use App\Http\Requests\PortfolioImageEditRequest;
use Illuminate\Http\Request;

/**
 *
 * @author silver.ibenye
 *
 */
class PortfolioController extends Controller
{
    /**
     *
     * @var PortfolioService
     */
    private $portfolioService;

    /**
     * Create a new portfolio controller instance.
     *
     * @return void
     */
    public function __construct(PortfolioService $portfolioService)
    {
        $this->portfolioService = $portfolioService;

        $this->middleware('web');
        $this->middleware('auth');
        $this->middleware('ajax',
                [
                        'only' => [
                                'deletePortfolioImage',
                                'deletePortfolioAudio'
                        ]
                ]);
    }

    /**
     * Show the portfolio images edit page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showImages()
    {
        $images = $this->portfolioService->getUserImagePortfolio();
        $viewBag = [
                'images' => $images
        ];
        return view('account.portfolio_images_edit',
                [
                        'viewBag' => $viewBag
                ]);
    }

    /**
     * Show the portfolio audios edit page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showAudios()
    {
        $audios = $this->portfolioService->getUserAudioPortfolio();
        $viewBag = [
                'audios' => $audios
        ];
        return view('account.portfolio_audios_edit',
                [
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
     * Show new portfolio audio page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addPortfolioAudio()
    {
        return view('account.portfolio_audio_add', [
                'viewBag' => [ ]
        ]);
    }

    /**
     * Show edit single portfolio image page.
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
     * Show edit single portfolio audio page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editPortfolioAudio($audioId)
    {
        $portfolioAudio = $this->portfolioService->getUserAudioPortfolio($audioId);
        return view('account.portfolio_audio_edit',
                [
                        'viewBag' => $portfolioAudio [0]
                ]);
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

        return redirect()->route('edit-portfolio-images');
    }

    /**
     * Save portfolio audio.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function savePortfolioAudio(PortfolioAudioAddRequest $request)
    {
        $audio = $request->file('audio', NULL);
        $caption = $request->input('caption');

        $file = $audio->getClientOriginalName();
        $mime = $audio->getMimeType();
        $ext = $audio->getExtension();

        $response = $this->portfolioService->saveUserPortfolioAudio($audio, $caption);

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

            $request->session()->flash('requestError', $response ['error']);
            return back()->withInput();
        }

        return redirect()->route('edit-portfolio-images');
    }

    /**
     * Update Portfolio audio.
     *
     * @param PortfolioImageEditRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function updatePortfolioAudio(PortfolioAudioEditRequest $request)
    {
        $audioId = $request->input('audioId');
        $caption = $request->input('caption');

        $response = $this->portfolioService->updateUserPorfolioAudio($audioId, $caption);

        if (array_key_exists('error', $response)) {

            $request->session()->flash('requestError', $response ['error']);
            return back()->withInput();
        }

        return redirect()->route('account');
    }

    /**
     * Delete user's portfolio image.
     *
     * @param Request $request
     */
    public function deletePortfolioImage(Request $request)
    {
        $imageId = $request->get('imageId');

        $response = $this->portfolioService->deleteUserPortfolioImage($imageId);

        return $response;
    }

    /**
     * Delete user's portfolio audio.
     *
     * @param Request $request
     */
    public function deletePortfolioAudio(Request $request)
    {
        $audioId = $request->get('audioId');

        $response = $this->portfolioService->deleteUserPortfolioAudio($audioId);

        return $response;
    }
}