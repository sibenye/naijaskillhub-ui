<div>
    <div class="nsh-card mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
        <h2 class="mdl-card__title-text">Portfolio Audios</h2>
        </div>
        <div class="nsh-card-content">
            <div id="portfolioAudioList" class="nsh-portfolioAudio-edit-list">
           @if (empty($viewBag['audios']))
                <p id="emptyPortfolioAudioList">You have no portfolio audios, click the <b style="font-size: 24px;">+</b> button below to add audio clips.</p>
            @else
                    @foreach ($viewBag['audios'] as $audio)
                        <div id="audioBlock-{{ $audio['audioId'] }}" class="row mdl-card__actions mdl-card--border">
                            <div class="col-md-5 col-xs-12">
                                <audio id="audio-{{ $audio['audioId'] }}" src="{{ $audio['fileSrc'] }}" controls></audio>
                            </div>
                            <div class="col-md-5 col-xs-12">
                                <span>{{ $audio['caption'] }}</span>
                            </div>
                            <div class="col-md-2 col-xs-12">
                                    <div class="col-xs-6"><span onclick="deletePortfolioAudio({{ $audio['audioId'] }})"><i class="material-icons">&#xE92B;</i></span></div>
                                    <div class="col-xs-6"><span onclick="editPortfolioAudio({{ $audio['audioId'] }})"><i class="material-icons">&#xE3C9;</i></span></div>
                            </div>
                        </div>

                    @endforeach
            @endif
            </div>

        </div>

        <div class="mdl-card__actions mdl-card--border">
            <div>
                <a href="{{ route('add-portfolio-audio') }}" >
	                <button type="submit" class="mdl-button mdl-button--file mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored nsh-right">
	                    <i class="material-icons">&#xE145;</i>
	                </button>
                </a>
            </div>
        </div>
    </div>
</div>