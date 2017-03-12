@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="nsh-card-center mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title"><h2 class="mdl-card__title-text">Login</h2></div>
                <div class="nsh-card-content">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

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

                        <div class="form-group">
                        <div class="col-md-12">
                        <div class="col-lg-6">
                            <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
                              <input type="checkbox" id="checkbox-1" class="mdl-checkbox__input" name="remember" {{ old('remember') ? 'checked' : '' }}>
                              <span class="mdl-checkbox__label">Remember Me</span>
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                        </div></div>

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
                                    Login
                                </button>
                            </div>
                        </div>
                        </div>
                        </div>
                    </form>
                    <br/>
                    <div class="nsh-card-footer clear-fix">
                            <p>Don't have an account? Then <a href="{{ url('/register') }}">register here</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
