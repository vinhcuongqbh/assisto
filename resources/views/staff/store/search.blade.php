@extends('layouts.master2')

@section('title', 'Store')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a href="{{ route('staff.store.create') }}"><button type="button"
                                        class="btn bg-olive text-white w-100">{{ __('newStore') }}</button></a>
                            </div>
                        </div>
                    </div>
                    <!-- form start -->
                    <form class="form-horizontal" action="{{ route('staff.store.search') }}" method="get"
                        id="store-search">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row"
                                style="display: flex; align-items: center; justify-content: center;">
                                <label for="storeID" class="col-md-2 col-form-label">{{ __('storeID') }}</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="storeID" name="storeID">
                                </div>
                            </div>
                            <div class="form-group row"
                                style="display: flex; align-items: center; justify-content: center;">
                                <label for="storeName" class="col-md-2 col-form-label">{{ __('storeName') }}</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="storeName" name="storeName">
                                </div>
                            </div>
                            <div class="form-group row"
                                style="display: flex; align-items: center; justify-content: center;">
                                <label for="address" class="col-md-2 col-form-label">{{ __('address') }}</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="address" name="address">
                                </div>
                            </div>                            
                            <div class="form-group row"
                                style="display: flex; align-items: center; justify-content: center;">
                                <label for="telephone" class="col-md-2 col-form-label">{{ __('telephone') }}</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="telephone" name="telephone">
                                </div>
                            </div>
                            <div class="form-group row"
                                style="display: flex; align-items: center; justify-content: center;">
                                <label for="centerID" class="col-md-2 col-form-label">{{ __('centerID') }}</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="centerID" name="centerID">
                                </div>
                            </div>                            
                            <div class="form-group row" style="display: flex; align-items: center; justify-content: center;" style="border:1px solid">
                                <div class="col-md-6">
                                    <button type="submit" class="btn bg-olive text-white w-20" style="position: relative; float: right;">{{ __('search') }}</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('js')
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $('#store-search').validate({
                rules: {
                    // date: {
                    //     required: true,
                    // },
                },
                messages: {
                    // date: {
                    //     required: "You must enter Date",
                    // },
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
