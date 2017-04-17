@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="nsh-card-center mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--primary mdl-color-text--white"><h2 class="mdl-card__title-text">Login</h2></div>
                <div class="nsh-card-content">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                               <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="mdl-textfield__error">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="password" id="password" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="mdl-textfield__error">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <!-- <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div> -->
                            <div class="col-md-6 col-md-offset-4">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                     Forgot Your Password?
                                </a>
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
