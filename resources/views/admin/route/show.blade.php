@extends('layouts.master')

@section('title', 'Route Information')

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
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="routeId">{{ __('routeID') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="routeId" name="routeId" value="{{ $route->routeId }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="routeDate">{{ __('dateDelivery') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="date" id="routeDate" name="routeDate" value="{{ $route->routeDate }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="staffId">{{ __('staffName') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="staffId" name="staffId" value="{{ $route->name }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="course">{{ __('course') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="course" name="course" value="{{ $route->course }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="storeId">{{ __('storeName') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="storeId" name="storeId" value="{{ $route->storeName }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-3 col-md-2">
                                <a href="{{ route('route.edit', $route->routeId) }}"><button type="button"
                                        class="btn bg-olive text-white w-100">{{ __('edit') }}</button></a>
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
@stop
