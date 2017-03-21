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
                            <div>
                                <div class="mdl-selectfield">
                                    <label>Member Type</label>
                                    <select class="browser-default" id="accountType" name="accountType">
                                      <option value="" disabled selected>Member Type</option>
                                      <option value="talent">Talent</option>
                                      <option value="hunter">Hunter</option>
                                    </select>
                                  </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                            <div>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input" type="text" id="firstName" name="firstName" value="{{ old('firstName') }}">
                                    <label class="mdl-textfield__label" for="firstName">First Name</label>
                                </div>
                                @if ($errors->has('firstName'))
                                    <span class="mdl-textfield__error">
                                        {{ $errors->first('firstName') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                            <div>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input" type="text" id="lastName" name="lastName" value="{{ old('lastName') }}">
                                    <label class="mdl-textfield__label" for="lastName">Last Name</label>
                                </div>
                                @if ($errors->has('lastName'))
                                    <span class="mdl-textfield__error">
                                        {{ $errors->first('lastName') }}
                                    </span>
                                @endif
                            </div>
                        </div>

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
                            <div>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input id="password-confirm" class="mdl-textfield__input" type="password" id="password" name="password_confirmation">
                                    <label class="mdl-textfield__label" for="password">Confirm Password</label>

                                </div>
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
