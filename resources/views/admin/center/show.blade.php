@extends('layouts.master')

@section('title', 'Center Information')

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
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="centerId">{{ __('centerID') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="centerId" name="centerId" value="{{ $center->centerId }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="centerName">{{ __('centerName') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="centerName" name="centerName" value="{{ $center->centerName }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="tel">{{ __('telephone') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="tel" name="tel" value="{{ $center->centerTel }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="centerAddr">{{ __('address') }}</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="centerAddr" name="centerAddr" value="{{ $center->centerAddr }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex justify-content-center">
                        <a class="btn btn-warning w-100 text-nowrap m-1"
                            href="{{ route('center.edit', $center->centerId) }}">{{ __('edit') }}</a>
                        <a class="btn bg-olive text-white w-100 text-nowrap m-1"
                            href="{{ route('center') }}">{{ __('back') }}</a>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@stop
