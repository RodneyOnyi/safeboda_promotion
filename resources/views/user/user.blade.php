@extends('layouts.app', ['activePage' => 'users'])
@section('content')

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">

                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Users</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Add User</a>
                        </div>
                    </div>
                </div>

                <div class="col-6 ml-0">
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
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif

                  @if($errors->any())
                  <div class="alert alert-danger alert-dismissible fade show">
                      Sorry, we are unable to delete this user
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  @endif
                </div>
                <!-- Light table -->
                <div class="table-responsive mt-4 mb-4">
                    <table class="table align-items-center table-flush" id="datatable-basic">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Name</th>
                                <th scope="col" class="sort" data-sort="email">Email</th>
                                <th scope="col" class="sort" data-sort="add">Add Vehicle</th>
                                <th scope="col" class="sort" data-sort="status">Status</th>
                                <th scope="col" class="sort" data-sort="action">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">{{ $user->first_name}} {{$user->middle_name ? $user->middle_name : ''}}  {{ $user->last_name}}</span>
                                        </div>
                                    </div>
                                </th>
                                <td class="email">
                                    <a href="mailto:{{ $user->email}}">{{ $user->email}}</a>
                                </td>
                                @if($user->rights_group == 4)
                                <th class="add">
                                    <a href="{{ route('vehicle.create') }}" class="btn btn-sm btn-primary">Add Vehicle</a>
                                </th>
                                @else
                                <th class="add">
                                    <a href="#" class="btn btn-sm btn-danger">N/A</a>
                                </th>
                                @endif
                                <td>
                                    <span class="badge badge-dot mr-4">
                                        <i class="bg-{{ $user->status == '1' ? 'success' : 'danger' }}"></i>
                                        <span class="status">{{ $user->status == '1' ?
                                            __('Active') : __('Inactive')
                                            }}</span>
                                    </span>
                                </td>

                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}">Edit</a>
                                            <button class="delete-action dropdown-item" data-id="{{ $user->id }}" data-toggle="modal" data-target="#deleteAction">Delete</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="deleteAction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('user.delete')}} " method="POST">
            @csrf
            @method('PUT')

              <div class="modal-body">
                Are you you want to delete this user ?
                <input type="hidden" name="user_id" id="user_id" value=""/>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Yes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
              </div>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection
