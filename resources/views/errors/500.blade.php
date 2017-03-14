@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="nsh-card-center mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                    <h2 class="mdl-card__title-text">INTERNAL SERVER ERROR</h2></div>
                <div class="nsh-card-content">
                <br/><br/>
                    <p>An internal server error occurred. Please contact support.</p>
                    @if ($exception->getMessage)
                       <p>{{ $exception->getMessage }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection