@extends('layouts.master')

@section('title', 'Center Edit')

@section('heading')
    {{ __('centerManagement') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold">{{ __('centerInformation') }}</h3>
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
                    <form action="{{ route('center.update', $center->centerId) }}" method="post" id="center-edit">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="centerId">{{ __('centerID') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="centerId" name="centerId" value="{{ $center->centerId }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="centerName">{{ __('centerName') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="centerName" name="centerName"
                                        value="{{ $center->centerName }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="centerTel">{{ __('telephone') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="centerTel" name="centerTel" value="{{ $center->centerTel }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="centerAddr">{{ __('address') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="centerAddr" name="centerAddr"
                                        value="{{ $center->centerAddr }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-center">
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
@stop

@section('js')
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $('#center-edit').validate({
                rules: {
                    centerId: {
                        required: true,
                    },
                    centerName: {
                        required: true,
                    },
                },
                messages: {
                    centerId: {
                        required: "{{ __('enterCenterID') }}",
                    },
                    centerName: {
                        required: "{{ __('enterCenterName') }}",
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
