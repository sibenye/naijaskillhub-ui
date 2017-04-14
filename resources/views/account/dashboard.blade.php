@extends('layouts.app')

@section('title', 'My Account')

@push('nsh-scripts')
    <script src="{{ asset('js/nsh-dashboard-page-functions.js') }}"></script>
@endpush

@section('content')
<div class="container">
<div class="row">
<nav class="nsh-dashboard-sidebar-fixed col-md-3">
    <div class="">
      <ul class="">
        <li class="active"><a href="#section1">Section 1</a></li>
        <li><a href="#section2">Section 2</a></li>
        <li><a href="#section3">Section 3</a></li>
      </ul>
    </div>

</nav>
  <div class="nsh-dashboard-content col-md-8 col-md-offset-4">
      @include('account.components.profile_section')
      @include('account.components.portfolio_image_section')
      @include('account.components.portfolio_audio_section')
    </div>

</div>
</div>
@endsection