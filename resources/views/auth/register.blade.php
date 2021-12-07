@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-3">
        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>{{ __('Sign Up as Rider.') }}</small>
                        </div>
                        <form role="form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row mb--3">
                              <div class="col-lg-6 form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                                  <div class="input-group input-group-alternative mb-3">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                      </div>
                                      <input class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="{{ __('First Name') }}" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus>
                                  </div>
                                  @if ($errors->has('first_name'))
                                      <span class="invalid-feedback" style="display: block;" role="alert">
                                          <strong>{{ $errors->first('first_name') }}</strong>
                                      </span>
                                  @endif
                              </div>
                              <div class="col-lg-6 form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                                  <div class="input-group input-group-alternative">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                      </div>
                                      <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Last Name') }}" type="text" name="last_name" value="{{ old('last_name') }}" required autofocus>
                                  </div>
                                  @if ($errors->has('last_name'))
                                      <span class="invalid-feedback" style="display: block;" role="alert">
                                          <strong>{{ $errors->first('last_name') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" type="password" name="password" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="{{ __('Confirm Password') }}" type="password" name="password_confirmation" required>
                                </div>
                            </div>
                            <!--<div class="text-muted font-italic">
                                <small>{{ __('password strength') }}: <span class="text-success font-weight-700">{{ __('strong') }}</span></small>
                            </div>-->
                            <div class="row my-4">
                                <div class="col-12">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                                        <label class="custom-control-label" for="customCheckRegister">
                                            <span class="text-muted">{{ __('I agree with the') }} <a href="#!">{{ __('Privacy Policy') }}</a></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">{{ __('Create account') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
