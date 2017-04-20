@extends('layouts.app')

@section('title', 'My Account - Portfolio Videos')

@push('nsh-scripts')
<script src="{{ asset('js/nsh-dashboard-page-functions.js') }}"></script>
@endpush

@section('content')
<div class="container">

<div class="row">

<div class="col-md-8 col-md-offset-2">
<div class="row">
<div class="col-xs-6">
<a href="{{ route('dashboard') }}" >
<i class="material-icons">&#xE5C4;</i>
</a>
</div>
<div class="col-xs-6">
<a href="{{ route('add-portfolio-video') }}" >
<button id="profileSaveBtn" class="mdl-button mdl-button--accent mdl-js-button mdl-js-ripple-effect nsh-right">
    Add Video
</button>
</a>
</div>
</div>

@include('account.components.portfolio_video_section')
</div>

</div>
</div>
@endsection