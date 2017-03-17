@extends('layouts.app')

@section('title', 'My Account')

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
      @include('components.profile_edit')
    </div>

</div>
</div>
@endsection