@extends('layouts.app', ['title' => __('Add User'),'activePage' => 'user'])
@section('content')

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-10 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Add User') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('user.store') }}" autocomplete="off">
                        @csrf

                        <h6 class="heading-small text-muted mb-4">
                            {{ __('User information') }}
                        </h6>

                        @if (session('status'))
                        <div class="row">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        @endif

                        @if (session('status_fail'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('status_fail') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @foreach ($errors->all() as $error)
                            {{ $error }}<br/>
                        @endforeach

                        <div class="row pl-lg-4">
                            <div class="col-lg-4 col-md-12 form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-first_name">{{ __('First Name') }}</label>
                                <input type="text" name="first_name" id="input-first_name" class="form-control form-control-alternative{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="{{ __('First Name') }}"
                                  value="{{ old('first_name')}}" required autofocus />

                                @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name')
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-4 col-md-12 form-group{{ $errors->has('middle_name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-first_name">{{ __('Middle Name') }}</label>
                                <input type="text" name="middle_name" id="input-middle_name" class="form-control form-control-alternative{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Middle Name') }}"
                                  value="{{ old('middle_name')}}" autofocus />

                                @if ($errors->has('middle_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('middle_name')
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-4 col-md-12 form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-last_name">{{ __('Last Name') }}</label>
                                <input type="text" name="last_name" id="input-last_name" class="form-control form-control-alternative{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Last Name') }}"
                                  value="{{ old('last_name')}}" required autofocus />

                                @if ($errors->has('last_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('last_name')
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row pl-lg-4">
                            <div class="col-lg-6 col-md-12 form-group{{ $errors->has('rights_group')  ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-rights_group">{{ __('Rights Group') }}
                                </label>
                                <select data-toggle="select" class="form-control form-control-alternative{{ $errors->has('rights_group') ? ' is-invalid' : '' }}" id="rights_group" name="rights_group">
                                    <option value="0">Select Group</option>
                                    @foreach($right_groups as $rights_group)
                                    <option value=" {{ $rights_group->id }}" {{($rights_group->id == old('rights_group')) ? 'selected'
                                        : '' }}>{{ $rights_group->name
                                        }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('rights_group'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('rights_group')}}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-lg-6 col-md-12 form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email')}}" required
                                  autofocus />

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row pl-lg-4" id="hidden_garage" style="display: {{ old('rights_group') && old('rights_group') != 1 ? 'block' : 'none' }}">

                              @if(auth()->user()->rights_group == 1)
                                  <div class="col-lg-6 col-md-12 form-group{{ $errors->has('garage') ? ' has-danger' : '' }}">
                                      <label class="form-control-label" for="input-garage">{{ __('Garage') }} </label>
                                      <select data-toggle="select" class="form-control form-control-alternative{{ $errors->has('garage') ? ' is-invalid' : '' }}" id="garage" name="garage">
                                          <option value="">Select Garage</option>
                                          @foreach($garages as $garage)
                                          <option value=" {{ $garage->id }}" {{($garage->id == old('garage')) ? 'selected' : '' }}>{{ $garage->name }}</option>
                                          @endforeach
                                      </select>

                                      @if ($errors->has('garage'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>Please select a garage</strong>
                                      </span>
                                      @endif
                                  </div>
                                @else
                                  <input type="hidden" name="garage" value="{{ auth()->user()->garage_id }}" required >
                                @endif

                            <div class="col-lg-6 col-md-12 form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-phone_number">{{ __('Phone Number') }}</label>
                                <input type="text" name="phone_number" id="input-phone_number" class="form-control form-control-alternative{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone Number') }}"
                                  value="{{ old('phone_number')}}" autofocus />

                                @if ($errors->has('phone_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone_number')}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-password">{{ __('Password') }}</label>
                            <input type="text" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" required />

                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">
                                {{ __('Add User') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('custom') }}/js/user.js"></script>
@endpush
