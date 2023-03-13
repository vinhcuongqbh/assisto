@extends('layouts.master')

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
                    <form action="{{ route('staff.accident.update', $accident->acc_id) }}" method="post" id="accident-edit"
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
                                                value="{{ $accident->acc_date }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('time') }}</label>
                                            <input type="time" class="form-control" id="time" name="time"
                                                value="{{ $accident->acc_time }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('coordinates') }}</label>
                                            <input type="text" class="form-control" id="coordinates" name="coordinates"
                                                value="{{ $accident->acc_coordinates }}">
                                        </div>
                                        <div class="row">
                                            <a class="btn btn-success w-100 btn-lg"><i class="fa fa-plus"></i>
                                                {{ __('getCoordinates') }}</a>
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
                                                value="{{ $accident->acc_involved_people_name }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('address') }}</label>
                                            <input type="text" class="form-control" id="peopleAddress"
                                                name="peopleAddress" value="{{ $accident->acc_involved_people_addr }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('telephone') }}</label>
                                            <input type="text" class="form-control" id="peopleTelephone"
                                                name="peopleTelephone" value="{{ $accident->acc_involved_people_tel }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('individualOrCompany') }}</label>
                                            <input type="text" class="form-control" id="peopleCompany"
                                                name="peopleCompany" value="{{ $accident->acc_involved_people_company }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('companyContact') }}</label>
                                            <input type="tel" class="form-control" id="companyContact"
                                                name="companyContact"
                                                value="{{ $accident->acc_involved_people_company_contact }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('personInCharge') }}</label>
                                            <input type="tel" class="form-control" id="personInCharge"
                                                name="personInCharge"
                                                value="{{ $accident->acc_involved_people_person_in_charge }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('carPlates') }}</label>
                                            <input type="tel" class="form-control" id="carPlates" name="carPlates"
                                                value="{{ $accident->acc_involved_people_car_plates }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('insuranceCompanyName') }}</label>
                                            <input type="tel" class="form-control" id="insuranceCompanyName"
                                                name="insuranceCompanyName"
                                                value="{{ $accident->acc_involved_people_insurance_company }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">{{ __('insuranceCompanyContact') }}</label>
                                            <input type="tel" class="form-control" id="insuranceCompanyContact"
                                                name="insuranceCompanyContact"
                                                value="{{ $accident->acc_involved_people_insurance_company_contact }}">
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
                                        <div class="form-group row">
                                            <label class="col-form-label">1. {{ __('frontCar') }}</label>
                                            <div class="input-group" style="margin-bottom:10px">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="frontVictimCar"
                                                        accept="image/*">
                                                    <label class="custom-file-label"
                                                        for="inputFile">{{ __('selectFile') }}</label>
                                                </div>
                                            </div>
                                            @if (isset($accidentMedias))
                                                <?php
                                                $img = ['jpg', 'jpeg', 'png', 'bmp'];
                                                ?>
                                                <div
                                                    style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 10px;">
                                                    @foreach ($accidentMedias as $accidentMedia)
                                                        @if (in_array(substr($accidentMedia->acc_media_url, -3), $img) &&
                                                                $accidentMedia->acc_media_owner == 1 &&
                                                                $accidentMedia->acc_media_type == 1)
                                                            <div>
                                                                <img style="width:
                                                                100%"
                                                                    src="/storage/{{ $accidentMedia->acc_media_url }}">
                                                                <a
                                                                    href="{{ route('staff.accident.deleteImage', $accidentMedia->acc_media_id) }}"><button
                                                                        type="button" class="btn btn-sm bg-danger"
                                                                        style="float: right; margin-top: 5px">{{ __('delete') }}</button></a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">2. {{ __('fullCar') }}</label>
                                            <div class="input-group" style="margin-bottom:10px">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="fullVictimCar"
                                                        accept="image/*">
                                                    <label class="custom-file-label"
                                                        for="inputFile">{{ __('selectFile') }}</label>
                                                </div>
                                            </div>                                            
                                            @if (isset($accidentMedias))                                                
                                                <div
                                                    style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 10px;">
                                                    @foreach ($accidentMedias as $accidentMedia)
                                                        @if (in_array(substr($accidentMedia->acc_media_url, -3), $img) &&
                                                                $accidentMedia->acc_media_owner == 1 &&
                                                                $accidentMedia->acc_media_type == 2)
                                                            <div>
                                                                <img style="width:
                                                                100%"
                                                                    src="/storage/{{ $accidentMedia->acc_media_url }}">
                                                                <a
                                                                    href="{{ route('staff.accident.deleteImage', $accidentMedia->acc_media_id) }}"><button
                                                                        type="button" class="btn btn-sm bg-danger"
                                                                        style="float: right; margin-top: 5px">{{ __('delete') }}</button></a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">3. {{ __('damagePart') }}</label>
                                            <div class="input-group" style="margin-bottom:10px">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        name="victimDamagePart" accept="image/*">
                                                    <label class="custom-file-label"
                                                        for="inputFile">{{ __('selectFile') }}</label>
                                                </div>
                                            </div>
                                            @if (isset($accidentMedias))                                               
                                                <div
                                                    style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 10px;">
                                                    @foreach ($accidentMedias as $accidentMedia)
                                                        @if (in_array(substr($accidentMedia->acc_media_url, -3), $img) &&
                                                                $accidentMedia->acc_media_owner == 1 &&
                                                                $accidentMedia->acc_media_type == 3)
                                                            <div>
                                                                <img style="width:
                                                                100%"
                                                                    src="/storage/{{ $accidentMedia->acc_media_url }}">
                                                                <a
                                                                    href="{{ route('staff.accident.deleteImage', $accidentMedia->acc_media_id) }}"><button
                                                                        type="button" class="btn btn-sm bg-danger"
                                                                        style="float: right; margin-top: 5px">{{ __('delete') }}</button></a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">4. {{ __('addImage') }}</label>
                                            <div class="input-group" style="margin-bottom:10px">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        name="victimAddImage[]" accept="image/*" multiple>
                                                    <label class="custom-file-label"
                                                        for="inputFile">{{ __('selectFile') }}</label>
                                                </div>
                                            </div>
                                            @if (isset($accidentMedias))
                                                <div
                                                    style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 10px;">
                                                    @foreach ($accidentMedias as $accidentMedia)
                                                        @if (in_array(substr($accidentMedia->acc_media_url, -3), $img) &&
                                                                $accidentMedia->acc_media_owner == 1 &&
                                                                $accidentMedia->acc_media_type == 4)
                                                            <div>
                                                                <img style="width:
                                                                100%"
                                                                    src="/storage/{{ $accidentMedia->acc_media_url }}">
                                                                <a
                                                                    href="{{ route('staff.accident.deleteImage', $accidentMedia->acc_media_id) }}"><button
                                                                        type="button" class="btn btn-sm bg-danger"
                                                                        style="float: right; margin-top: 5px">{{ __('delete') }}</button></a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h2 class="card-title">{{ __('carImage') }}</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-form-label">1. {{ __('frontCar') }}</label>
                                            <div class="input-group" style="margin-bottom:10px">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        name="frontCar" accept="image/*">
                                                    <label class="custom-file-label"
                                                        for="inputFile">{{ __('selectFile') }}</label>
                                                </div>
                                            </div>
                                            @if (isset($accidentMedias))
                                                <div
                                                    style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 10px;">
                                                    @foreach ($accidentMedias as $accidentMedia)
                                                        @if (in_array(substr($accidentMedia->acc_media_url, -3), $img) &&
                                                                $accidentMedia->acc_media_owner == 0 &&
                                                                $accidentMedia->acc_media_type == 1)
                                                            <div>
                                                                <img style="width:
                                                                100%"
                                                                    src="/storage/{{ $accidentMedia->acc_media_url }}">
                                                                <a
                                                                    href="{{ route('staff.accident.deleteImage', $accidentMedia->acc_media_id) }}"><button
                                                                        type="button" class="btn btn-sm bg-danger"
                                                                        style="float: right; margin-top: 5px">{{ __('delete') }}</button></a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">2. {{ __('fullCar') }}</label>
                                            <div class="input-group" style="margin-bottom:10px">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        name="fullCar" accept="image/*">
                                                    <label class="custom-file-label"
                                                        for="inputFile">{{ __('selectFile') }}</label>
                                                </div>
                                            </div>
                                            @if (isset($accidentMedias))
                                                <div
                                                    style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 10px;">
                                                    @foreach ($accidentMedias as $accidentMedia)
                                                        @if (in_array(substr($accidentMedia->acc_media_url, -3), $img) &&
                                                                $accidentMedia->acc_media_owner == 0 &&
                                                                $accidentMedia->acc_media_type == 2)
                                                            <div>
                                                                <img style="width:
                                                                100%"
                                                                    src="/storage/{{ $accidentMedia->acc_media_url }}">
                                                                <a
                                                                    href="{{ route('staff.accident.deleteImage', $accidentMedia->acc_media_id) }}"><button
                                                                        type="button" class="btn btn-sm bg-danger"
                                                                        style="float: right; margin-top: 5px">{{ __('delete') }}</button></a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">3. {{ __('damagePart') }}</label>
                                            <div class="input-group" style="margin-bottom:10px">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        name="damagePart" accept="image/*">
                                                    <label class="custom-file-label"
                                                        for="inputFile">{{ __('selectFile') }}</label>
                                                </div>
                                            </div>
                                            @if (isset($accidentMedias))
                                                <div
                                                    style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 10px;">
                                                    @foreach ($accidentMedias as $accidentMedia)
                                                        @if (in_array(substr($accidentMedia->acc_media_url, -3), $img) &&
                                                                $accidentMedia->acc_media_owner == 0 &&
                                                                $accidentMedia->acc_media_type == 3)
                                                            <div>
                                                                <img style="width:
                                                                100%"
                                                                    src="/storage/{{ $accidentMedia->acc_media_url }}">
                                                                <a
                                                                    href="{{ route('staff.accident.deleteImage', $accidentMedia->acc_media_id) }}"><button
                                                                        type="button" class="btn btn-sm bg-danger"
                                                                        style="float: right; margin-top: 5px">{{ __('delete') }}</button></a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">4. {{ __('addImage') }}</label>
                                            <div class="input-group" style="margin-bottom:10px">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        name="addImage[]" accept="image/*" multiple>
                                                    <label class="custom-file-label"
                                                        for="inputFile">{{ __('selectFile') }}</label>
                                                </div>
                                            </div>
                                            @if (isset($accidentMedias))
                                                <div
                                                    style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 10px;">
                                                    @foreach ($accidentMedias as $accidentMedia)
                                                        @if (in_array(substr($accidentMedia->acc_media_url, -3), $img) &&
                                                                $accidentMedia->acc_media_owner == 0 &&
                                                                $accidentMedia->acc_media_type == 4)
                                                            <div>
                                                                <img style="width:
                                                                100%"
                                                                    src="/storage/{{ $accidentMedia->acc_media_url }}">
                                                                <a
                                                                    href="{{ route('staff.accident.deleteImage', $accidentMedia->acc_media_id) }}"><button
                                                                        type="button" class="btn btn-sm bg-danger"
                                                                        style="float: right; margin-top: 5px">{{ __('delete') }}</button></a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-body">
                                        <p>速報的な意味合いと、現場でしか取れない情報（特に写真）に絞り、事故時にSDが操作に手間取り時間がかかることで相手が感情的になることも考慮したいと考えます。
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>

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
    </script>
@stop
