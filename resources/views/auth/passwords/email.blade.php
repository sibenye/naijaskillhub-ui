@extends('layouts.app')

@section('title', 'Send Reset Password Link')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="nsh-card-center mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--primary mdl-color-text--white"><h2 class="mdl-card__title-text">Reset Password</h2></div>
                <div class="nsh-card-content">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="email">Email Address</label>
                            <div class="col-md-6">
                                <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="mdl-textfield__error">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="mdl-card__actions mdl-card--border">
                        <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <a href="{{ url('/home') }}" class="mdl-button mdl-button--accent mdl-js-button mdl-js-ripple-effect nsh-left">
                                  Cancel
                                </a>
                            </div>

                            <div class="col-md-6">
                                <button type="submit" class="mdl-button mdl-button--accent mdl-js-button mdl-js-ripple-effect nsh-right">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
