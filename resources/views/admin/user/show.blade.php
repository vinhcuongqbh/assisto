@extends('layouts.master')

@section('title', 'User Information')

@section('heading')
    {{ __('userManagement') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8">
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
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex justify-content-center">
                        <a class="btn btn-warning w-100 text-nowrap m-1" href="{{ route('user.edit', $user->userId) }}">{{ __('edit') }}</a>
                        <a class="btn bg-olive text-white w-100 text-nowrap m-1" href="{{ route('user') }}">{{ __('back') }}</a>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->    
@stop

@section('css')
@stop

@section('js')
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
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
