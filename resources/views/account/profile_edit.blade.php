@extends('layouts.app')

@section('title', 'My Account - Edit Profile')

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
</div>

@include('account.components.profile_section')
</div>

</div>
</div>
@endsection