<div>
    <div class="nsh-card mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
        <h2 class="mdl-card__title-text">Portfolio Images</h2>
        </div>
        <div class="nsh-card-content">
            <div id="portfolioImageList" class="nsh-portfolioImage-edit-list">
           @if (empty($viewBag['images']))
                <p id="emptyPortfolioImageList">You have no portfolio images, click the <b style="font-size: 24px;">+</b> button below to add images.</p>
            @else

                    @foreach ($viewBag['images'] as $image)
                        <div id="imageBlock-{{ $image['imageId'] }}" class="mdl-card  mdl-shadow--2dp">
                            <a id="figure-{{ $image['imageId'] }}" onclick="editPortfolioImage({{ $image['imageId'] }})">
                                <figure class="mdl-card__media">
                                    <img id="image-{{ $image['imageId'] }}" src="{{ $image['fileSrc'] }}" alt="">

                                </figure>
                            </a>
                            <div id="caption-{{ $image['imageId'] }}" class="nsh-small-card-content"><span>{{$image['caption']}}</span></div>
                            <input id="imageId-{{ $image['imageId'] }}" type="hidden" value="{{ $image['imageId'] }}">

                            <div id="imageBlockFooter" class="mdl-card__actions mdl-card--border">
                            <span id="deleteImageBtn-{{ $image['imageId'] }}" class="nsh-left" onclick="deletePortfolioImage({{ $image['imageId'] }})"><i class="material-icons">&#xE92B;</i></span>
                            <span class="nsh-right" onclick="editPortfolioImage({{ $image['imageId'] }})"><i class="material-icons">&#xE3C9;</i></span>
                            </div>
                        </div>
                    @endforeach
            @endif
            </div>

        </div>

        <div class="mdl-card__actions mdl-card--border">
            <div>
                <a href="{{ route('add-portfolio-image') }}" >
	                <button type="submit" class="mdl-button mdl-button--file mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored nsh-right">
	                    <i class="material-icons">&#xE145;</i>
	                </button>
                </a>
            </div>
        </div>
    </div>
</div>