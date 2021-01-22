@extends('layouts.main')
@section('title', 'Админка')

@section('content')
    <div class="p-4 shadow mb-5">
        @if(session('status'))
            <h3 class="text-center mb-5">{{ session('status') }}</h3>
        @endif
        @forelse($users as $user)
            <div class="p-3 shadow mb-5">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <h4 class="d-flex align-items-center">
                            <a href="/user/{{ $user->id }}" class="nav-link">{{ $user->name }}</a>
                        </h4>
                        <div class="m-3 d-flex">
                            <a href="/admin/delUser/{{ $user->id }}" class="nav-link badge bg-danger">{{ __('messages.pages.admin.hardDelete') }}</a>
                        </div>
                    </div>
                   <div class="d-flex align-items-center">
                       <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal"
                               data-bs-target="#editUserPass{{ $user->id }}">
                           {{ __('messages.pages.admin.changePassword') }}
                       </button>
                       <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                               data-bs-target="#editUser{{ $user->id }}">
                           {{ __('messages.pages.admin.editUser') }}
                       </button>
                       <div class="modal fade" id="editUserPass{{ $user->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">{{ $user->name }}</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal"
                                               aria-label="Close"></button>
                                   </div>
                                   <div class="modal-body">
                                       <form method="post" action="/admin/savePass/{{ $user->id }}">
                                           @csrf
                                           <div class="mb-3">
                                               <label for="login{{ $user->id }}" class="form-label">{{ __('messages.pages.admin.newPassword') }}</label>
                                               <input type="text" name="password" class="form-control"
                                                      id="login{{ $user->id }}">
                                               @if($errors->has('password'))
                                                   <div class="alert alert-danger p-2">
                                                       @foreach($errors->get('password') as $error)
                                                           <p class="m-0">{{ $error }}</p>
                                                       @endforeach
                                                   </div>
                                               @endif
                                           </div>
                                           <div class="d-grid justify-content-end">
                                               <button class="btn btn-primary px-4">{{ __('messages.pages.admin.save') }}</button>
                                           </div>
                                       </form>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">{{ $user->name }}</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal"
                                               aria-label="Close"></button>
                                   </div>
                                   <div class="modal-body">
                                       <form method="post" action="/admin/saveUser/{{ $user->id }}">
                                           @csrf
                                           <div class="mb-3">
                                               <label for="login{{ $user->id }}" class="form-label">{{ __('messages.pages.other.login') }}</label>
                                               <input type="text" name="name" class="form-control"
                                                      id="login{{ $user->id }}"
                                                      value="{{ $user->name }}">
                                               @if($errors->has('name'))
                                                   <div class="alert alert-danger p-2">
                                                       @foreach($errors->get('name') as $error)
                                                           <p class="m-0">{{ $error }}</p>
                                                       @endforeach
                                                   </div>
                                               @endif
                                           </div>
                                           <div class="mb-3">
                                               <label for="email{{ $user->id }}" class="form-label">{{ __('messages.pages.other.email') }}</label>
                                               <input type="email" name="email" class="form-control"
                                                      id="email{{ $user->id }}"
                                                      value="{{ $user->email }}">
                                               @if($errors->has('email'))
                                                   <div class="alert alert-danger p-2">
                                                       @foreach($errors->get('email') as $error)
                                                           <p class="m-0">{{ $error }}</p>
                                                       @endforeach
                                                   </div>
                                               @endif
                                           </div>
                                           <div class="mb-3">
                                               <label for="role{{ $user->id }}" class="form-label">{{ __('messages.pages.admin.role') }}</label>
                                               <select class="form-select" id="role{{ $user->id }}" name="role_id">
                                                   @foreach($roles as $role)
                                                       <option value="{{ $role->id }}"
                                                               @if($user->role_id === $role->id)
                                                               selected
                                                           @endif>{{ $role->name }}</option>
                                                   @endforeach
                                               </select>
                                               @if($errors->has('role_id'))
                                                   <div class="alert alert-danger p-2">
                                                       @foreach($errors->get('role_id') as $error)
                                                           <p class="m-0">{{ $error }}</p>
                                                       @endforeach
                                                   </div>
                                               @endif
                                           </div>
                                           <div class="d-grid justify-content-end">
                                               <button class="btn btn-primary px-4">{{ __('messages.pages.admin.save') }}</button>
                                           </div>
                                       </form>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                </div>
            </div>
        @empty
            <div class="p-3 shadow mb-5">{{ __('messages.pages.admin.notUser') }}</div>
        @endforelse
    </div>
    <div class="mb-5 pb-5">
        {{ $users->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
