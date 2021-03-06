@extends('layouts.app')

@section('title', 'My Account - Add Portfolio Image')

@section('content')
<div class="container">
<div class="row">
  <div class="col-md-8 col-md-offset-2">
     <div class="nsh-card-center mdl-card mdl-shadow--2dp">
     	<div class="mdl-card__title mdl-color--primary mdl-color-text--white">
     		<h2 class="mdl-card__title-text">Add Portfolio Image</h2>
     	</div>
     	<figure id="portfolioImagePreviewSection" class="mdl-card__media nsh-hide">
            <img id="portfolioImagePreview" src="" alt="" />
        </figure>
     	<div class="nsh-card-content">
     		@if (Session::has('requestError'))
				<span class="mdl-textfield__error">{{ session('requestError') }}</span>
     		@endif
     		<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ route('save-portfolio-image') }}">
				{{ csrf_field() }}

                <div class="form-group">
                       <label for="image" class="col-md-4 control-label">Image File</label>
                        <div class="col-md-6">
                            <input id="portfolioImageUploadSelection" type="file" name="image" class="form-control" value="{{ old('image') }}" required>
                            @if ($errors->has('image'))
                                <span class="mdl-textfield__error">
                                    {{ $errors->first('image') }}
                                </span>
                            @endif
                        </div>
                </div>
                <div class="form-group">
                       <label for="caption" class="col-md-4 control-label">Caption</label>
                        <div class="col-md-6">
                            <input type="text" name="caption" class="form-control" maxlength="140" size="50" value="{{ old('caption') }}">
                            @if ($errors->has('caption'))
                                <span class="mdl-textfield__error">
                                    {{ $errors->first('caption') }}
                                </span>
                            @endif
                        </div>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <a href="{{ route('edit-portfolio-images') }}" class="mdl-button mdl-button--accent mdl-js-button mdl-js-ripple-effect nsh-left">
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