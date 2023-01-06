@extends('layouts.master')

@section('title', 'User Create')

@section('heading')
    {{ __('userManagement') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold">{{ __('newUser') }}</h3>
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
                    <form action="{{ route('user.store') }}" method="post" id="user-create">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="userId">{{ __('userID') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="userId" name="userId" value="{{ old('userId') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="name">{{ __('userName') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="password">{{ __('password') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="password" id="password" name="password" value=""
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="centerId">{{ __('centerName') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <select id="centerId" name="centerId" class="form-control custom-select">
                                        <option selected disabled></option>
                                        @foreach ($center as $i)
                                            <option value="{{ $i->centerId }}">{{ $i->centerName }}</option>
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
                                        <option selected disabled></option>
                                        @foreach ($userRole as $i)
                                            <option value="{{ $i->roleId }}">{{ $i->roleName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row justify-content-end">
                                <div class="col-4 col-md-3">
                                    <button type="submit" class="btn bg-olive text-white w-100">{{ __('create') }}</button>
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
            $('#user-create').validate({
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
