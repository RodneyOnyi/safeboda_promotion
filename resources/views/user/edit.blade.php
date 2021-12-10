@extends('layouts.app', ['title' => __('Edit User'),'activePage' => 'user'])

@section('content')

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-10 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Edit User') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('user.update', $user->id) }}" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>

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

                        <div class="pl-lg-4">
                            <div class="row">
                              <div class="col-lg-4 col-md-12 form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                                  <label class="form-control-label" for="input-first_name">{{ __('First Name') }}</label>
                                  <input type="text" name="first_name" id="input-first_name" class="form-control form-control-alternative{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="{{ __('First Name') }}"
                                    value="{{ old('first_name', $user->first_name)}}" required autofocus>

                                  @if ($errors->has('first_name'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('first_name') }}</strong>
                                  </span>
                                  @endif

                              </div>
                              <div class="col-lg-4 col-md-12 form-group{{ $errors->has('middle_name') ? ' has-danger' : '' }}">
                                  <label class="form-control-label" for="input-first_name">{{ __('Middle Name') }}</label>
                                  <input type="text" name="middle_name" id="input-middle_name" class="form-control form-control-alternative{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Middle Name') }}"
                                    value="{{ old('middle_name',$user->middle_name)}}" autofocus>

                                  @if ($errors->has('middle_name'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('middle_name') }}</strong>
                                  </span>
                                  @endif
                              </div>
                              <div class="col-lg-4 col-md-12 form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                                  <label class="form-control-label" for="input-last_name">{{ __('Last Name') }}</label>
                                  <input type="text" name="last_name" id="input-last_name" class="form-control form-control-alternative{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Last Name') }}"
                                    value="{{ old('last_name',$user->last_name)}}" required autofocus>

                                  @if ($errors->has('last_name'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('last_name') }}</strong>
                                  </span>
                                  @endif
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-lg-6 col-md-12 form-group">
                                  <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                  <input type="email" name="email" id="input-email" class="form-control" placeholder="{{ __('Email') }}"
                                   value="{{ old('email',$user->email)}}" disabled >
                              </div>
                            <div class="col-lg-6 col-md-12 form-group{{ $errors->has('rights_group') || $errors->has('clinic') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-rights_group">{{ __('Rights Group') }} </label>
                                <select data-toggle="select" class="form-control form-control-alternative{{ $errors->has('rights_group') || $errors->has('clinic') ? ' is-invalid' : '' }}"  id="rights_group" name="rights_group">
                                    <option value="0">Select Group</option>
                                    @foreach($right_groups as $rights_group)
                                      <option value=" {{ $rights_group->id,$user->rights_group }}" {{($rights_group->id == $user->rights_group) ? 'selected' : '' }} >{{ $rights_group->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('rights_group'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('rights_group') }}</strong>
                                </span>
                                @endif
                                @if ($errors->has('clinic'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Please select a clinic to continue</strong>
                                </span>
                                @endif
                            </div>
                          </div>

                          <div class="row" id="hidden_garage" style="display: {{  old('rights_group',$user->rights_group) != 1 ? '' : 'none' }}">
                              <div class="col-lg-6 col-md-12 form-group{{ $errors->has('garage') ? ' has-danger' : '' }}">
                                  <label class="form-control-label" for="input-rights_group">{{ __('Garage') }}
                                  </label>
                                  <select class="form-control form-control-alternative{{ $errors->has('garage') ? ' is-invalid' : '' }}" id="garage" name="garage">
                                      <option value="">Select Garage</option>
                                      @foreach($garages as $garage)
                                      <option value=" {{ $garage->id }}" {{($garage->id == old('garage', $user->garage_id)) ? 'selected' : ''
                                          }}>{{ $garage->name }}</option>
                                      @endforeach
                                  </select>
                              </div>

                              <div class="col-lg-6 col-md-12 form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }}">
                                  <label class="form-control-label" for="input-phone_number">{{ __('Phone Number') }}</label>
                                  <input type="text" name="phone_number" id="input-phone_number" class="form-control form-control-alternative{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone Number') }}"
                                    value="{{ old('phone_number',$user->phone_number)}}" autofocus />

                                  @if ($errors->has('phone_number'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('phone_number')}}</strong>
                                  </span>
                                  @endif
                              </div>
                          </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-warning mt-4">{{ __('Edit User') }}</button>
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
