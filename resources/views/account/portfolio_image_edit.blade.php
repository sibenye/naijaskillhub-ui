@extends('layouts.app')

@section('title', 'Edit Portfolio Image')

@section('content')
<div class="container">
<div class="row">
  <div class="col-md-8 col-md-offset-2">
     <div class="nsh-card-center mdl-card mdl-shadow--2dp">
     	<div class="mdl-card__title mdl-color--primary mdl-color-text--white">
     		<h2 class="mdl-card__title-text">Edit Portfolio Image</h2>
     	</div>
     	<figure id="portfolioImagePreviewSection" class="mdl-card__media">
            <img id="portfolioImagePreview" src="{{ $viewBag['fileSrc'] }}" alt="" />
        </figure>
     	<div class="nsh-card-content">
     		@if (Session::has('requestError'))
				<span class="mdl-textfield__error">{{ session('requestError') }}</span>
     		@endif
     		<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ route('update-portfolio-image') }}">
				{{ csrf_field() }}


                <div class="form-group">
                       <label for="caption" class="col-md-4 control-label">Caption</label>
                        <div class="col-md-6">
                            <input type="text" name="caption" class="form-control" maxlength="140" size="50" value="{{ $viewBag['caption'] }}">
                            @if ($errors->has('caption'))
                                <span class="mdl-textfield__error">
                                    {{ $errors->first('caption') }}
                                </span>
                            @endif
                        </div>
                </div>
                <input type=hidden name="imageId" value="{{ $viewBag['imageId'] }}">
                <div class="mdl-card__actions mdl-card--border">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <a href="{{ route('account') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect nsh-left">
                                  Cancel
                                </a>
                            </div>

                            <div class="col-md-6">
                                <button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect nsh-right">
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