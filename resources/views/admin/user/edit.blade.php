@extends('layouts.master')

@section('title', 'User Edit')

@section('heading')
    {{ __('userManagement') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold">{{ __('userInformation') }}</h3>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('user.update', $user->userId) }}" method="post" id="user-edit">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="userId">{{ __('userID') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="userId" name="userId" value="{{ $user->userId }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="name">{{ __('userName') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="name" name="name" value="{{ $user->name }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="centerId">{{ __('centerName') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <select id="centerId" name="centerId" class="form-control custom-select">
                                        @foreach ($center as $i)
                                            <option value="{{ $i->centerId }}"
                                                @if ($i->centerId == $user->centerId) {{ 'selected' }} @endif>
                                                {{ $i->centerName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="roleId">{{ __('userRole') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <select id="roleId" name="roleId" class="form-control custom-select">
                                        @foreach ($userRole as $i)
                                            <option value="{{ $i->roleId }}"
                                                @if ($i->roleId == $user->roleId) {{ 'selected' }} @endif>
                                                {{ $i->roleName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger text-white w-100 text-nowrap m-1"
                                data-toggle="modal" data-target="#reset-pass">{{ __('changePassword') }}</button>
                            <button type="submit"
                                class="btn btn-warning w-100 text-nowrap m-1">{{ __('update') }}</button>
                            <button onclick="javascript:history.back()"
                                class="btn bg-olive text-white w-100 text-nowrap m-1">{{ __('back') }}</button>
                        </div>
                    </form>
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
                                <label for="confirmPassword" class="col-form-label">{{ __('confirmPassword') }}</label>
                            </div>
                            <div class="col-8">
                                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" id="userId2" name="userId" value="{{ $user->userId }}">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn bg-olive text-white text-nowrap"
                            data-dismiss="modal">{{ __('close') }}</button>
                        <button type="submit" class="btn bg-olive text-white text-nowrap">{{ __('update') }}</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>
@stop

@section('js')
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $('#user-edit').validate({
                rules: {
                    userId: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                    centerId: {
                        required: true,
                    },
                    roleId: {
                        required: true,
                    }
                },
                messages: {
                    userId: {
                        required: "{{ __('enterUserID') }}",
                    },
                    name: {
                        required: "{{ __('enterUserName') }}",
                    },
                    centerId: {
                        required: "{{ __('selectCenterName') }}",
                    },
                    roleId: {
                        required: "{{ __('selectUserRole') }}",
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-sm-9').append(error);

                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    <script>
        //Kiểm tra dữ liệu đầu vào
        $(function() {
            $('#form-resetpass').validate({
                rules: {
                    confirmPassword: {
                        equalTo: "#password"
                    }
                },
                messages: {
                    confirmPassword: "{{ __('samePassword') }}",
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('div').append(error);

                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@stop
