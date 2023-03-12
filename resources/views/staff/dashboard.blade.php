@extends('layouts.master2')

@section('title', 'Store')

@section('content')
<div class="container">
    <div class="asabo-main-body">
        <div class="asabo-box">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="text-align:center">
                            <p class="text-lg-center">{{ __('slogan') }}</p>
                            <p class="text-lg-center text-bold">{{ $setting->slogan }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <a class="btn btn-lg bg-olive text-white w-100 p-3" href="/staff/store">{{ __('store') }}</a>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-lg bg-olive text-white w-100 p-3" href="/staff/accident">{{ __('accident') }}</a>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-lg bg-olive text-white w-100 p-3" href="/staff/track">{{ __('track') }}</a>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-lg bg-olive text-white w-100 p-3" href="/staff/guide">{{ __('guide') }}</a>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.row -->
    </div>
</div>
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
