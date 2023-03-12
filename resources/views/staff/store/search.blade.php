@extends('layouts.master2')

@section('title', 'Store')

@section('heading')
{{ __('storeInformation') }}
@stop

@section('content')
<div class="container">
    <div class="asabo-main-body">
        <div class="asabo-box">
            <div class="row">
                <div class="col-md-12 w-100">
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto">
                                    <a class="btn bg-olive text-white w-100" href="{{ route('staff.store.create') }}"><i class="fa fa-plus"></i> {{ __('newStore') }}</a>
                                </div>
                            </div>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('staff.store.search') }}" method="post" id="store-search">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="storeID" name="storeID" placeholder="{{ __('storeID') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="storeName" name="storeName" placeholder="{{ __('storeName') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="address" name="address" placeholder="{{ __('address') }}">
                                </div>                            
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="telephone" name="telephone" placeholder="{{ __('telephone') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="centerID" name="centerID" placeholder="{{ __('centerID') }}">
                                </div>    
                                <div class="form-group m-0">
                                    <input type="text" class="form-control form-control-lg" id="centerName" name="centerName" placeholder="{{ __('centerName') }}">
                                </div>                         
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-lg bg-olive text-white w-100" style="position: relative; float: right;">{{ __('search') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
        </div>
        <!-- /.row -->
    </div>
</div><!-- /.container-fluid -->
@stop

@section('js')
<!-- jquery-validation -->
<script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="/vendor/jquery-validation/additional-methods.min.js"></script>
<!-- Page specific script -->
<script>
$(function () {
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
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.col-sm-9').append(error);

    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }
});
});
</script>
@stop
