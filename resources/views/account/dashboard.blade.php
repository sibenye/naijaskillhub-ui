@extends('layouts.app')

@section('title', 'My Account - Dashboard')

@push('nsh-scripts')
    <script src="{{ asset('js/nsh-dashboard-page-functions.js') }}"></script>
@endpush

@section('content')
<div class="container">
<div class="row">
  <div class="col-md-6">
    <h2>My Dashboard</h2>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
      <div class="nsh-card mdl-card mdl-shadow--2dp">
          <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
            <h2 class="mdl-card__title-text">Profile</h2>
          </div>
          <div class="nsh-card-content nsh-dashboard-card-content">
          <p><a href="{{ route('edit-profile') }}">Profile Details</a></p>
          <p><a href="#">Physical Details</a></p>
          <p><a href="#">Social Links and Websites</a></p>
          </div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="nsh-card mdl-card mdl-shadow--2dp">
          <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
            <h2 class="mdl-card__title-text">Media</h2>
          </div>
          <div class="nsh-card-content nsh-dashboard-card-content">
          <p><a href="{{ route('edit-portfolio-images') }}">Portfolio Images - {{ $viewBag['user']['portfolioSummary']['numberOfImages'] }}</a></p>
          <p><a href="{{ route('edit-portfolio-audios') }}">Portfolio Audios - {{ $viewBag['user']['portfolioSummary']['numberOfAudios'] }}</a></p>
          <p><a href="#">Portfolio Videos - {{ $viewBag['user']['portfolioSummary']['numberOfVideos'] }}</a></p>
          </div>
      </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
      <div class="nsh-card mdl-card mdl-shadow--2dp">
          <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
            <h2 class="mdl-card__title-text">Interests, Experiences, and Education</h2>
          </div>
          <div class="nsh-card-content nsh-dashboard-card-content">
          <p><a href="#">Education</a></p>
          <p><a href="#">Work Experience</a></p>
          <p><a href="#">Interests</a></p>
          </div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="nsh-card mdl-card mdl-shadow--2dp">
          <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
            <h2 class="mdl-card__title-text">Membership Package</h2>
          </div>
          <div class="nsh-card-content nsh-dashboard-card-content">
          </div>
      </div>
  </div>
</div>
</div>
@endsection