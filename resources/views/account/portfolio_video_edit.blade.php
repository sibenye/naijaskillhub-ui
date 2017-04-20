@extends('layouts.app')

@section('title', 'My Account - Edit Portfolio Video')

@section('content')
<div class="container">
<div class="row">
  <div class="col-md-8 col-md-offset-2">
     <div class="nsh-card-center mdl-card mdl-shadow--2dp">
     	<div class="mdl-card__title mdl-color--primary mdl-color-text--white">
     		<h2 class="mdl-card__title-text">Edit Portfolio Video</h2>
     	</div>
        <figure id="portfolioVideoPreviewSection" class="mdl-card__media">
            <iframe width="560" height="315" src="{{ $viewBag['videoSrc'] }}" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen></iframe>
        </figure>
     	<div class="nsh-card-content">
     		@if (Session::has('requestError'))
				<span class="mdl-textfield__error">{{ session('requestError') }}</span>
     		@endif
     		<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ route('update-portfolio-video') }}">
				{{ csrf_field() }}

                <div class="form-group">
                       <label for="caption" class="col-md-4 control-label">Caption</label>
                        <div class="col-md-6">
                            <input type="text" name="caption" class="form-control" maxlength="80" size="50" value="{{ $viewBag['caption'] }}">
                            @if ($errors->has('caption'))
                                <span class="mdl-textfield__error">
                                    {{ $errors->first('caption') }}
                                </span>
                            @endif
                        </div>
                </div>
                <input type=hidden name="videoId" value="{{ $viewBag['videoId'] }}">
                <div class="mdl-card__actions mdl-card--border">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <a href="{{ route('edit-portfolio-videos') }}" class="mdl-button mdl-button--accent mdl-js-button mdl-js-ripple-effect nsh-left">
                                  Cancel
                                </a>
                            </div>

                            <div class="col-md-6">
                                <button type="submit" class="mdl-button mdl-button--accent mdl-js-button mdl-js-ripple-effect nsh-right">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
     		</form>
     	</div>
     </div>
  </div>

</div>
</div>
@endsection