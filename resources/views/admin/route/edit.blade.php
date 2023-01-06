@extends('layouts.master')

@section('title', 'Route Edit')

@section('heading')
    {{ __('routeManagement') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold">{{ __('routeInformation') }}</h3>
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
                    <form action="{{ route('route.update', $route->routeId) }}" method="post" id="route-edit">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="routeId">{{ __('routeID') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="routeId" name="routeId" value="{{ $route->routeId }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="routeDate">{{ __('dateDelivery') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="date" id="routeDate" name="routeDate" value="{{ $route->routeDate }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="staffId">{{ __('staffName') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <select id="staffId" name="staffId" class="form-control custom-select">
                                        @foreach ($staff as $i)
                                            <option value="{{ $i->userId }}"
                                                @if ($i->userId == $route->staffId) {{ 'selected' }} @endif>
                                                {{ $i->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="course">{{ __('course') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="course" name="course" value="{{ $route->course }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="storeId">{{ __('storeName') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <select id="storeId" name="storeId" class="form-control custom-select">
                                        @foreach ($store as $i)
                                            <option value="{{ $i->storeId }}"
                                                @if ($i->storeId == $route->storeId) {{ 'selected' }} @endif>
                                                {{ $i->storeName }}</option>
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
            $('#route-edit').validate({
                rules: {
                    routeId: {
                        required: true,
                    },
                    routeDate: {
                        required: true,
                    },
                    staffId: {
                        required: true,
                    },
                    storeId: {
                        required: true,
                    },
                },
                messages: {
                    routeId: {
                        required: "{{ __('enterRouteID') }}",
                    },
                    routeDate: {
                        required: "{{ __('selectDate') }}",
                    },
                    staffId: {
                        required: "{{ __('selectStaffName') }}",
                    },
                    storeId: {
                        required: "{{ __('selectStoreName') }}",
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
