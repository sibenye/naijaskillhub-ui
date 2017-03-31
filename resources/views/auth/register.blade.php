@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="nsh-card-center mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--primary mdl-color-text--white"><h2 class="mdl-card__title-text">Register</h2></div>
                <div class="nsh-card-content">
                    @if (Session::has('apiError'))
                    <span>{{ Session::get('apiError') }}</span>
                    <br/>
                    @endIf
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="accountType">Member Type</label>

                            <div class="col-md-6">
                                <select class="form-control" id="accountType" name="accountType">
                                  <option value="talent">Talent</option>
                                  <option value="hunter">Hunter</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label" for="firstName">First Name</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="firstName" name="firstName" value="{{ old('firstName') }}" required>

                                    @if ($errors->has('firstName'))
                                        <span class="mdl-textfield__error">
                                            {{ $errors->first('firstName') }}
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label" for="lastName">Last Name</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="lastName" name="lastName" value="{{ old('lastName') }}" required>

                                    @if ($errors->has('lastName'))
                                        <span class="mdl-textfield__error">
                                            {{ $errors->first('lastName') }}
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label" for="email">Email Address</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="example@domain.com" required>

                                    @if ($errors->has('email'))
                                        <span class="mdl-textfield__error">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label" for="password">Password</label>
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
                                <label class="col-md-4 control-label" for="password">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" class="form-control" type="password" id="password" name="password_confirmation" required>
                                </div>
                        </div>
                        <input type="hidden" id="credentialType" name="credentialType" value="standard">

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
                                    Register
                                </button>
                            </div>
                        </div>
                        </div>
                        </div>

                    </form>
                    <br/>
                    <div class="nsh-card-footer clear-fix">
                            <p>Already have an account? Then <a href="{{ url('/login') }}">login here</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
