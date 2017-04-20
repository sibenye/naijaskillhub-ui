<div>
    <div class="nsh-card mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
        <h2 class="mdl-card__title-text">Portfolio Videos</h2>
        </div>
        <div class="nsh-card-content">
            <div id="portfolioVideoList" class="nsh-portfolioVideo-edit-list">
           @if (empty($viewBag['videos']))
                <p id="emptyPortfolioVideoList">You have no portfolio videos, click the <b style="font-size: 24px;">+</b> button below to add video.</p>
            @else
                    @foreach ($viewBag['videos'] as $video)
                        <div id="videoBlock-{{ $video['videoId'] }}" class="mdl-card  mdl-shadow--2dp">
                                <a id="figure-{{ $video['videoId'] }}" onclick="editPortfolioVideo({{ $video['videoId'] }})">
                                    <figure class="mdl-card__media">
                                        <img id="video-{{ $video['videoId'] }}" src="{{ $video['videoScreenUrl'] }}" alt="">
                                    </figure>
                                </a>
                                <div id="caption-{{ $video['videoId'] }}" class="nsh-small-card-content"><span>{{$video['caption']}}</span></div>
                                <div id="videoBlockFooter" class="mdl-card__actions mdl-card--border">
                                        <span class="nsh-left" onclick="deletePortfolioVideo({{ $video['videoId'] }})"><i class="material-icons">&#xE92B;</i></span>
                                        <span class="nsh-right" onclick="editPortfolioVideo({{ $video['videoId'] }})"><i class="material-icons">&#xE3C9;</i></span>
                                </div>
                        </div>

                    @endforeach
            @endif
            </div>

        </div>

        <div class="mdl-card__actions mdl-card--border">
            <div>
                <a href="{{ route('add-portfolio-video') }}" >
	                <button type="submit" class="mdl-button mdl-button--file mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored nsh-right">
	                    <i class="material-icons">&#xE145;</i>
	                </button>
                </a>
            </div>
        </div>
    </div>
</div>