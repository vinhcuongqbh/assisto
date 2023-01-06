@extends('layouts.master')

@section('title', 'User Edit')

@section('heading')
    {{ __('userManagement') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
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
                            <div class="form-group row justify-content-end">
                                <div class="col-4 col-md-3">
                                    <button type="submit" class="btn bg-olive text-white w-100">{{ __('update') }}</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
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
                    },
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
                    },
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
@stop
