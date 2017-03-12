@extends('layouts.canopy')

@section('title', 'Home')

@section('body')
<!-- Always shows a header, even in smaller screens. -->
<div class="nsh-home-layout-header">
  <div class="nsh-navigation-transparent">
    <div class="nsh-navigation-row">
      <!-- Title -->
      <span class="nsh-navigation-title">Title</span>

      <nav class="nsh-navigation-menu-section">
        @if (Auth::check())
            <a href="{{ url('/home') }}">Home</a>
        @else
            <a class="nsh-navigation-menu-section-item" href="{{ url('/register') }}">Join Free</a>
            <a class="nsh-navigation-menu-section-item" href="{{ url('/login') }}">Log In</a>
        @endif
      </nav>
    </div>
  </div>

  <div class="nsh-header-content">
    <div class="nsh-header-content-title">
        Find the Right Talent
    </div>

    <div><button class="btn btn-primary" type="submit">Search</button></div>
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
