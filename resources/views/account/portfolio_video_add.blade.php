@extends('layouts.app')

@section('title', 'My Account - Add Portfolio Video')

@section('content')
<div class="container">
<div class="row">
  <div class="col-md-8 col-md-offset-2">
     <div class="nsh-card-center mdl-card mdl-shadow--2dp">
     	<div class="mdl-card__title mdl-color--primary mdl-color-text--white">
     		<h2 class="mdl-card__title-text">Add Portfolio Video</h2>
     	</div>

     	<div class="nsh-card-content">
     		<div class="nsh-card-content-copy">
     			<p>Copy your <b><a target="_blank" href="https://www.youtube.com/">YouTube</a></b> or <b><a target="_blank" href="https://vimeo.com/">Vimeo</a></b> video url and paste it below.
     				<br/>e.g. https://www.youtube.com/watch?v=FFMgffPj9pM
     			</p>

     		</div>
     		@if (Session::has('requestError'))
				<span class="mdl-textfield__error">{{ session('requestError') }}</span>
     		@endif
     		<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ route('save-portfolio-video') }}">
				{{ csrf_field() }}

                <div class="form-group">
                       <label for="videoUrl" class="col-md-4 control-label">Video Url</label>
                        <div class="col-md-6">
                            <input type="text" name="videoUrl" class="form-control" maxlength="500" size="150" value="{{ old('videoUrl') }}" required>
                            @if ($errors->has('videoUrl'))
                                <span class="mdl-textfield__error">
                                    {{ $errors->first('videoUrl') }}
                                </span>
                            @endif
                        </div>
                </div>

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