@extends('layouts.canopy')

@section('title', 'Home')

@section('body')
<!-- Always shows a header, even in smaller screens. -->
<div class="nsh-home-layout-header">
  <div class="nsh-navigation-transparent">
    <div class="nsh-navigation-row">
      <!-- Title -->
      <span class="nsh-navigation-title">
        <img width=300 height=70 alt="Brand" src="{{ asset('images/nsh_logo_transparent.png') }}">
      </span>

      <nav class="nsh-navigation-menu-section">
      <div>
        <ul class="nsh-navigation-menu-section-item">
				@component('components.navbaritems')
				@endcomponent
			</ul>
        </div>
      </nav>
    </div>
  </div>

  <div class="nsh-header-content">
    <div class="nsh-header-content-title">
        Find the Right Talent
    </div>

    <div><button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--raised" type="submit">Search</button></div>
  </div>
</div>
<div class="page-content"><!-- Your content goes here -->
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                Laravel
            </div>

            <div class="links">
            </div>
        </div>
    </div>
</div>

@endsection
