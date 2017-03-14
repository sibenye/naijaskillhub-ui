@extends('layouts.app')

@section('title', 'My Account')

@section('content')
<div class="container">

<h1>Edit Profile</h1>
<p>{{session('authToken')}}</p>
</div>
@endsection