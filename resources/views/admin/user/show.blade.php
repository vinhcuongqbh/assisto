@extends('layouts.master')

@section('title', 'User Information')

@section('heading')
    {{ __('userManagement') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('userInformation') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="userId">{{ __('userID') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="userId" name="userId" value="{{ $user->userId }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="name">{{ __('userName') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" value="{{ $user->name }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="center">{{ __('centerName') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="center" name="center" value="{{ $user->centerName }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="roleId">{{ __('userRole') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="userRole" name="userRole" value="{{ $user->roleName }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-3">
                                <button type="button" class="btn btn-block btn-outline-success"
                                    style="padding-left:0px; padding-right:0px" data-toggle="modal"
                                    data-target="#reset-pass">{{ __('newPassword') }}</button>
                            </div>
                            <div class="col-3">
                                <a href="{{ route('user.edit', $user->userId) }}"><button type="button"
                                        class="btn btn-block btn-outline-secondary">{{ __('edit') }}</button></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    {{-- Cấp lại mật mã --}}
    <form action="{{ route('user.resetpass', $user->userId) }}" method="post" id="form-resetpass">
        @csrf
        <div class="modal fade" id="reset-pass">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('changePassword') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="password" class="col-form-label">{{ __('newPassword') }}</label>
                            </div>
                            <div class="col-8">
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="confirmpassword" class="col-form-label">{{ __('confirmPassword') }}</label>
                            </div>
                            <div class="col-8">
                                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" id="userId" name="userId" value="{{ $user->userId }}">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('close') }}</button>
                        <button type="submit" class="btn btn-outline-secondary">{{ __('update') }}</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>
@stop
