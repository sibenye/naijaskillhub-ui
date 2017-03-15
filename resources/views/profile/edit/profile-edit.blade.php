@extends('layouts.app')

@section('title', 'My Account')

@section('content')
<div class="container">
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer">
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Title</span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="">Link</a>
      <a class="mdl-navigation__link" href="">Link</a>
      <a class="mdl-navigation__link" href="">Link</a>
      <a class="mdl-navigation__link" href="">Link</a>
    </nav>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content">
    <h1>Edit Profile</h1>
    <p>Email: {{Auth::User()->email}}</p>

    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    <p>Email: {{Auth::User()->email}}</p>
    </div>
  </main>
</div>


</div>
@endsection