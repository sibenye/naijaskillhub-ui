@extends('layouts.app')

@section('title', 'Reset Password')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="nsh-card-center mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title"><h2 class="mdl-card__title-text">Reset Password</h2></div>

                <div class="nsh-card-content">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input" type="email" id="email" name="email" value="{{ old('email') }}">
                                    <label class="mdl-textfield__label" for="email">Email Address</label>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="mdl-textfield__error">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input" type="password" id="password" name="password">
                                    <label class="mdl-textfield__label" for="password">Password</label>

                                </div>

                                @if ($errors->has('password'))
                                    <span class="mdl-textfield__error">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input id="password-confirm" class="mdl-textfield__input" type="password" id="password" name="password_confirmation">
                                    <label class="mdl-textfield__label" for="password">Confirm Password</label>

                                </div>
                            </div>
                        </div>

                        <div class="mdl-card__actions mdl-card--border">
                        <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <a href="{{ url('/home') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect nsh-left">
                                  Cancel
                                </a>
                            </div>

                            <div class="col-md-6">
                                <button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect nsh-right">
                                    Reset Password
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
