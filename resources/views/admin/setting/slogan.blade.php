@extends('layouts.master')

@section('title', 'Slogan')

@section('heading')
    {{ __('sloganSetting') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-default">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('slogan.store') }}" method="post" id="slogan-store">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="slogan">{{ __('sloganInput') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea id="slogan" name="slogan" class="form-control">@if (isset($setting)) {{ $setting->slogan }} @endif</textarea>
                                </div>
                            </div>
                            <div class="form-group row justify-content-end">
                                <div class="col-4 col-md-3">
                                    <button type="submit"
                                        class="btn bg-olive text-white w-100">{{ __('update') }}</button>
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
@stop
