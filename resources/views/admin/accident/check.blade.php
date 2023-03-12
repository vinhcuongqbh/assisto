@extends('layouts.master')

@section('title', 'Accident Create')

@section('heading')
    {{ __('accidentReports') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold text-lg">{{ __('accidentReports') }}</h3>
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
                    <form action="{{ route('accident.store') }}" method="post" id="accident-create"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div>
                                <label>事故対応</label>
                                <p>1. 負傷者の救護</p>
                                <p>&ensp; けが人がいないか確認し、けが人がいる場合は消防（119）に連絡する。可能な応急処置を行う。</p>                                
                                <p>2. 事故の続発防止措置</p>
                                <p>&ensp; 車の移動</p>
                                <p>&ensp; 後続車の誘導</p>
                                <p>&ensp; 道路上の障害物の除去等</p>
                                <p>&ensp; ※ただし続発事故の危険がない場合、事故車は動かさないほうがよい。</p>
                                <p>3. 警察への報告</p>
                                <p>&ensp; どんなに小さな事故でも報告の義務があります。</p>
                                <p>&ensp; 警察への報告内容</p>
                                <p>&emsp; 交通事故発生の日時・場所</p>
                                <p>&emsp; 死傷者の数及び負傷者の負傷の程度( いる場合)</p>
                                <p>&emsp; 損壊したもの及びその損壊の程度</p>
                                <p>&emsp; その交通事故にかかわる車両などの積載物</p>
                                <p>&emsp; その事故に対して講じた措置警察官の名前もメモをとっておくこと。</p>
                            </div>                            
                            <div class="form-group row justify-content-end">
                                <div class="col-3 col-md-2">
                                    <a href="{{ route('accident.create') }}"><button type="button" name="action" value="ok"
                                        class="btn bg-olive text-white w-100">{{ __('Ok') }}</button></a>
                                </div>                                
                            </div>
                        </div><!-- /.card-body -->
                    </form>
                </div><!-- /.card -->
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
            $('#accident-create').validate({
                rules: {
                    date: {
                        required: true,
                    },
                    time: {
                        required: true,
                    },
                    collisionPoint: {
                        required: true,
                    },                   
                },
                messages: {
                    date: {
                        required: "{{ __('selectDate') }}",
                    },
                    time: {
                        required: "{{ __('selectTime') }}",
                    },
                    collisionPoint: {
                        required: "{{ __('enterPlace') }}",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-12').append(error);

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
