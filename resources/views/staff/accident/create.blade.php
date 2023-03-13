@extends('layouts.master2')

@section('title', 'Accident Create')

@section('heading')
    {{ __('accidentReports') }}
@stop

@section('content')
    <div class="container">
        <div class="asabo-main-body">
            <div class="asabo-box">
                <div class="row">
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h2 class="card-title">{{ __('date/coordinates') }}</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('date') }}</label>
                                            <input type="date" class="form-control" id="date" name="date"
                                                value="{{ old('date') }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('time') }}</label>
                                            <input type="time" class="form-control" id="time" name="time"
                                                value="{{ old('time') }}">
                                        </div>
                                        <div class="row hide-on-desktop">
                                            <input type="text" name="lat_pos" id="lat_pos" hidden/>
                                            <input type="text" name="long_pos" id="long_pos" hidden/>
                                            <a id="location_button" class="btn btn-success w-100 btn-lg" href='javascript:;' onclick="getLocationConstant()"><i id="loc_loading" class="fas fa-cog fa-spin"></i>
                                                {{ __('getCoordinates') }}</a>
                                            <p id="location_message" class="text-center text-sm"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- END ROW TIME -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h2 class="card-title">{{ __('verificationOfOtherParty') }}</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('name') }}</label>
                                            <input type="text" class="form-control" id="peopleName" name="peopleName"
                                                value="{{ old('peopleName') }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('address') }}</label>
                                            <input type="text" class="form-control" id="peopleAddress"
                                                name="peopleAddress" value="{{ old('peopleAddress') }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('telephone') }}</label>
                                            <input type="text" class="form-control" id="peopleTelephone"
                                                name="peopleTelephone" value="{{ old('peopleTelephone') }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('individualOrCompany') }}</label>
                                            <input type="text" class="form-control" id="peopleCompany"
                                                name="peopleCompany" value="{{ old('peopleCompany') }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('companyContact') }}</label>
                                            <input type="tel" class="form-control" id="companyContact"
                                                name="companyContact" value="{{ old('companyContact') }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('personInCharge') }}</label>
                                            <input type="tel" class="form-control" id="personInCharge"
                                                name="personInCharge" value="{{ old('personInCharge') }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('carPlates') }}</label>
                                            <input type="tel" class="form-control" id="carPlates" name="carPlates"
                                                value="{{ old('carPlates') }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('insuranceCompanyName') }}</label>
                                            <input type="tel" class="form-control" id="insuranceCompanyName"
                                                name="insuranceCompanyName" value="{{ old('insuranceCompanyName') }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('insuranceCompanyContact') }}</label>
                                            <input type="tel" class="form-control" id="insuranceCompanyContact"
                                                name="insuranceCompanyContact"
                                                value="{{ old('insuranceCompanyContact') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- END ROW ACCIDENT -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h2 class="card-title">{{ __('victimCarImage') }}</h2>
                                    </div>
                                    <div class="card-body">
                                        <a id="cameraButton" class="btn btn-success mb-1 hide-on-desktop" href='javascript:;' onclick='takePicture();'><i class="fa fa-video"></i> 写真を撮る</a>
                                        <div class="form-group row">
                                            <label class="col-form-label">1. {{ __('frontCar') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="frontVictimCar"
                                                        accept="image/*">
                                                    <label class="custom-file-label"
                                                        for="inputFile">{{ __('selectFile') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">2. {{ __('fullCar') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="fullVictimCar"
                                                        accept="image/*">
                                                    <label class="custom-file-label"
                                                        for="inputFile">{{ __('selectFile') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">3. {{ __('damagePart') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        name="victimDamagePart" accept="image/*">
                                                    <label class="custom-file-label"
                                                        for="inputFile">{{ __('selectFile') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">4. {{ __('addImage') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        name="victimAddImage[]" accept="image/*" multiple>
                                                    <label class="custom-file-label"
                                                        for="inputFile">{{ __('selectFile') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- END ROW PIC -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h2 class="card-title">{{ __('carImage') }}</h2>
                                    </div>
                                    <div class="card-body">
                                        <a id="cameraButton" class="btn btn-success mb-1 hide-on-desktop" href='javascript:;' onclick='takePicture();'><i class="fa fa-video"></i> 写真を撮る</a>
                                        <div class="form-group row">
                                            <label class="col-form-label">1. {{ __('frontCar') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="frontCar"
                                                        accept="image/*">
                                                    <label class="custom-file-label"
                                                        for="inputFile">{{ __('selectFile') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">2. {{ __('fullCar') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="fullCar"
                                                        accept="image/*">
                                                    <label class="custom-file-label"
                                                        for="inputFile">{{ __('selectFile') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">3. {{ __('damagePart') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="damagePart"
                                                        accept="image/*">
                                                    <label class="custom-file-label"
                                                        for="inputFile">{{ __('selectFile') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">4. {{ __('addImage') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="addImage[]"
                                                        accept="image/*" multiple>
                                                    <label class="custom-file-label"
                                                        for="inputFile">{{ __('selectFile') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- END ROW PIC -->

                        <div class="row d-flex justify-content-center">
                            <button type="submit" name="action" value="report"
                                class="btn btn-lg bg-olive text-white w-100 text-nowrap m-1"
                                style="max-width: 400px;">{{ __('report') }}</button>
                            <button type="submit" name="action" value="draft"
                                class="btn btn-lg btn-warning text-white w-100 text-nowrap m-1"
                                style="max-width: 400px;">{{ __('draft') }}</button>
                            <a class="btn btn-lg btn-danger text-white w-100 text-nowrap m-1" style="max-width: 400px;"
                                href="{{ route('staff.accident.index') }}">{{ __('cancel') }}</a>
                        </div>
                    </form>
                </div><!-- /.row -->
            </div><!-- comment -->
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
                },
                messages: {
                    date: {
                        required: "{{ __('selectDate') }}",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);

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
        function takePicture() {
            NativeAndroid.takePicture();
        }
    </script>
    <script>
        document.getElementById("loc_loading").hidden = true;
        function getLocationConstant()
        {
            document.getElementById("loc_loading").hidden = false;
            if(navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(onGeoSuccess,onGeoError);
            } else {
                alert("GPS対応してません。");
            }
        }


        function onGeoSuccess(event)
        {
            document.getElementById("location_message").innerText =  "座標データを取得しました。";
            document.getElementById("lat_pos").value =  event.coords.latitude;
            document.getElementById("long_pos").value =  event.coords.longitude;
            document.getElementById("loc_loading").hidden = true;
        }


        function onGeoError(event)
        {
//            alert("Error code " + event.code + ". " + event.message);
            document.getElementById("loc_loading").hidden = true;
            alert("座標データができませんでした。");
        }
    </script>
@stop
