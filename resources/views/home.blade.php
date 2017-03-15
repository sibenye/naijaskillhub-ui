@extends('layouts.canopy')

@section('title', 'Home')

@section('body')
<!-- Always shows a header, even in smaller screens. -->
<div class="nsh-home-layout-header">
  <div class="nsh-navigation-transparent">
    <div class="nsh-navigation-row">

      <a href="{{ url('/') }}" alt="{{ config('app.name',
				'Naija Skill Hub') }}"><span class="nsh-navigation-title nsh-navigation-title-image">

      </span></a>

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
