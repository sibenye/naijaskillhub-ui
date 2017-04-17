@extends('layouts.app')

@section('title', 'My Account - Edit Profile')

@push('nsh-scripts')
<script src="{{ asset('js/nsh-dashboard-page-functions.js') }}"></script>
@endpush

@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
@include('account.components.profile_section')
</div>

</div>
</div>
@endsection