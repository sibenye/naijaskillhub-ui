<div>
    <div class="nsh-card mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
        <h2 class="mdl-card__title-text">Portfolio Images</h2>
        </div>
        <div class="nsh-card-content">
            <div id="portfolioImageList" class="nsh-portfolioImage-edit-list">
           @if (empty($viewBag['portfolio']['images']))
                <p id="emptyPortfolioImageList">You have no portfolio images, click the <b style="font-size: 24px;">+</b> button below to add images.</p>
            @else
                
                    @foreach ($viewBag['portfolio']['images'] as $image)
                        <div id="imageBlock-{{ $image['imageId'] }}">
                            <a id="figure-{{ $image['imageId'] }}">
                                <figure>
                                    <img id="image-{{ $image['imageId'] }}" src="{{ $image['fileSrc'] }}" alt="">
                                    <figcaption id="caption-{{ $image['imageId'] }}">{{$image['caption']}}</figcaption>
                                </figure>
                            </a>
                            <input id="imageId-{{ $image['imageId'] }}" type="hidden" value="{{ $image['imageId'] }}">
                            
                            <div id="imageBlockFooter-{{ $image['imageId'] }}">
                            <span class="nsh-left"><i class="material-icons">&#xE92B;</i></span>
                            <a href="{{ route('edit-portfolio-image', ['imageId' => $image['imageId']]) }}" ><span class="nsh-right"><i class="material-icons">&#xE3C9;</i></span></a>
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