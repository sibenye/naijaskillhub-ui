@extends('layouts.canopy')

@section('body')
@component('components.navbar')
@endcomponent

<div>
   @yield('content')
</div>
@endsection