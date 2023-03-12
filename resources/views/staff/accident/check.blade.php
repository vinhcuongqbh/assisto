@extends('layouts.master2')

@section('title', 'Accident Create')

@section('heading')
    {{ __('accidentReports') }}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold text-lg">事故対応</h3>
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
                    <form action="{{ route('staff.accident.store') }}" method="post" id="accident-create"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div>
                                <p class="text-bold">1. 負傷者の救護</p>
                                <p>&ensp; <input type="checkbox" id="checkbox1" onclick="myFunction()">
                                    けが人がいないか確認し、けが人がいる場合は消防（119）に連絡する。可能な応急処置を行う。</p>
                                <p class="text-bold">2. 事故の続発防止措置</p>
                                <p>&ensp; <input type="checkbox" id="checkbox2" onclick="myFunction()"> 車の移動</p>
                                <p>&ensp; <input type="checkbox" id="checkbox3" onclick="myFunction()"> 後続車の誘導</p>
                                <p>&ensp; <input type="checkbox" id="checkbox4" onclick="myFunction()"> 道路上の障害物の除去等</p>
                                <p>&ensp; ※ただし続発事故の危険がない場合、事故車は動かさないほうがよい。</p>
                                <p class="text-bold">3. 警察への報告</p>
                                <p>&ensp; <input type="checkbox" id="checkbox5" onclick="myFunction()">
                                    どんなに小さな事故でも報告の義務があります。</p>
                                <p>&ensp; <input type="checkbox" id="checkbox6" onclick="myFunction()"> 警察への報告内容</p>
                                <p>&emsp;&ensp; 交通事故発生の日時・場所</p>
                                <p>&emsp;&ensp; 死傷者の数及び負傷者の負傷の程度( いる場合)</p>
                                <p>&emsp;&ensp; 損壊したもの及びその損壊の程度</p>
                                <p>&emsp;&ensp; その交通事故にかかわる車両などの積載物</p>
                                <p>&emsp;&ensp; その事故に対して講じた措置警察官の名前もメモをとっておくこと。</p>
                            </div>
                        </div><!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-center">                            
                            <a class=" m-1 w-100" style="max-width: 400px;" href="{{ route('staff.accident.create') }}"><button type="button" name="action"
                                            value="ok" id="button" disabled
                                            class="btn btn-lg bg-olive text-white w-100 text-nowrap">{{ __('checked') }}</button></a>
                            <a class="btn btn-lg bg-olive text-white w-100 text-nowrap m-1" style="max-width: 400px;" href="{{ route('staff.accident.index') }}">{{ __('back') }}</a>
                        </div>
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

    <script>
        function myFunction() {
            // Get the checkbox
            var checkBox1 = document.getElementById("checkbox1");
            var checkBox2 = document.getElementById("checkbox2");
            var checkBox3 = document.getElementById("checkbox3");
            var checkBox4 = document.getElementById("checkbox4");
            var checkBox5 = document.getElementById("checkbox5");
            var checkBox6 = document.getElementById("checkbox6");
            // Get the output text
            var text = document.getElementById("text");

            // If the checkbox is checked, display the output text
            if ((checkBox1.checked == true) && (checkBox2.checked == true) && (checkBox3.checked == true) && (checkBox4
                    .checked == true) && (checkBox5.checked == true) && (checkBox6.checked == true)) {
                button.disabled = false;
            } else {
                button.disabled = true;
            }
        }
    </script>
@stop
