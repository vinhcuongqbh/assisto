@extends('layouts.master')

@section('title', 'Store Create')

@section('heading')
    {{ __('storeManagement') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold">{{ __('newStore') }}</h3>
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
                    <form action="{{ route('store.store') }}" method="post" id="store-create" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="storeId">{{ __('storeID') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="storeId" name="storeId" value="{{ old('storeId') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="storeName">{{ __('storeName') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="storeName" name="storeName" value="{{ old('storeName') }}"
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
                                    <label for="address">{{ __('address') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="address" id="address" name="address" value="{{ old('address') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="workTime">{{ __('workTime') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="workTime" name="workTime" value="{{ old('workTime') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="tel">{{ __('telephone') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="tel" name="tel" value="{{ old('tel') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="password">{{ __('doorPassword') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="password" name="password" value="{{ old('password') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="parkPos">{{ __('parkPosition') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="parkPos" name="parkPos" value="{{ old('parkPos') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="delivery">{{ __('deliveryType') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="delivery" name="delivery" value="{{ old('delivery') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="add1">{{ __('addtionally1') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="add1" name="add1" value="{{ old('add1') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="add2">{{ __('addtionally2') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="add2" name="add2" value="{{ old('add2') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="inputFile">{{ __('guideFile') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputFile"
                                                name="inputFile" accept="application/pdf">
                                            <label class="custom-file-label" for="inputFile">{{ __('') }}</label>
                                        </div>
                                    </div>
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
            $('#store-create').validate({
                rules: {
                    storeId: {
                        required: true,
                    },
                    centerId: {
                        required: true,
                    },
                    storeName: {
                        required: true,
                    },
                    inputFile: {
                        required: true,
                    },
                },
                messages: {
                    storeId: {
                        required: "{{ __('enterStoreID') }}",
                    },
                    centerId: {
                        required: "{{ __('selectCenterName') }}",
                    },
                    storeName: {
                        required: "{{ __('enterStoreName') }}"
                    },
                    inputFile: {
                        required: "{{ __('selectFile') }}"
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
    <script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@stop
