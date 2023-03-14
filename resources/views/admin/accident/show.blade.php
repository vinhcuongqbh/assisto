@extends('layouts.master')

@section('title', 'Accident Report')

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
                    <form>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h2 class="card-title">{{ __('date/coordinates') }}</h2>
                                    </div>
                                    <table class="table table-striped projects p-0 m-0" style="100%">
                                        <tbody>
                                            <tr>
                                                <td class="text-bold" style="width: 30%">
                                                    {{ __('date') }}
                                                </td>
                                                <td style="width: 70%">
                                                    {{ $accident->acc_date }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 30%">
                                                    {{ __('time') }}
                                                </td>
                                                <td style="width: 70%">
                                                    {{ $accident->acc_time }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 30%">
                                                    {{ __('coordinates') }}
                                                </td>
                                                <td style="width: 70%">
                                                    <a
                                                        href="https://www.google.com/maps/place/{{ $accident->acc_coordinates }}">{{ __('googleMaps') }}</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h2 class="card-title">{{ __('verificationOfOtherParty') }}</h2>
                                    </div>
                                    <table class="table table-striped projects p-0 m-0">
                                        <tbody>
                                            <tr>
                                                <td class="text-bold" style="width: 30%">
                                                    {{ __('name') }}
                                                </td>
                                                <td style="width: 70%">
                                                    {{ $accident->acc_involved_people_name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 30%">
                                                    {{ __('address') }}
                                                </td>
                                                <td style="width: 70%">
                                                    {{ $accident->acc_involved_people_addr }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 30%">
                                                    {{ __('telephone') }}
                                                </td>
                                                <td style="width: 70%">
                                                    {{ $accident->acc_involved_people_tel }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 30%">
                                                    {{ __('individualOrCompany') }}
                                                </td>
                                                <td style="width: 70%">
                                                    {{ $accident->acc_involved_people_company }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 30%">
                                                    {{ __('companyContact') }}
                                                </td>
                                                <td style="width: 70%">
                                                    {{ $accident->acc_involved_people_company_contact }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 30%">
                                                    {{ __('personInCharge') }}
                                                </td>
                                                <td style="width: 70%">
                                                    {{ $accident->acc_involved_people_person_in_charge }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 30%">
                                                    {{ __('carPlates') }}
                                                </td>
                                                <td style="width: 70%">
                                                    {{ $accident->acc_involved_people_car_plates }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 30%">
                                                    {{ __('insuranceCompanyName') }}
                                                </td>
                                                <td style="width: 70%">
                                                    {{ $accident->acc_involved_people_insurance_company }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 30%">
                                                    {{ __('insuranceCompanyContact') }}
                                                </td>
                                                <td style="width: 70%">
                                                    {{ $accident->acc_involved_people_insurance_company_contact }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h2 class="card-title">{{ __('victimCarImage') }}</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-form-label">1. {{ __('frontCar') }}</label>
                                            @if (isset($accidentMedias))
                                                <?php
                                                $i = 1;
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
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">2. {{ __('fullCar') }}</label>
                                            @if (isset($accidentMedias))
                                                <?php
                                                $i = 1;
                                                $img = ['jpg', 'jpeg', 'png', 'bmp'];
                                                ?>
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
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">3. {{ __('damagePart') }}</label>
                                            @if (isset($accidentMedias))
                                                <?php
                                                $i = 1;
                                                $img = ['jpg', 'jpeg', 'png', 'bmp'];
                                                ?>
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
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">4. {{ __('addImage') }}</label>
                                            @if (isset($accidentMedias))
                                                <?php
                                                $i = 1;
                                                $img = ['jpg', 'jpeg', 'png', 'bmp'];
                                                ?>
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
                                            @if (isset($accidentMedias))
                                                <?php
                                                $i = 1;
                                                $img = ['jpg', 'jpeg', 'png', 'bmp'];
                                                ?>
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
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">2. {{ __('fullCar') }}</label>
                                            @if (isset($accidentMedias))
                                                <?php
                                                $i = 1;
                                                $img = ['jpg', 'jpeg', 'png', 'bmp'];
                                                ?>
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
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">3. {{ __('damagePart') }}</label>
                                            @if (isset($accidentMedias))
                                                <?php
                                                $i = 1;
                                                $img = ['jpg', 'jpeg', 'png', 'bmp'];
                                                ?>
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
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label">4. {{ __('addImage') }}</label>
                                            @if (isset($accidentMedias))
                                                <?php
                                                $i = 1;
                                                $img = ['jpg', 'jpeg', 'png', 'bmp'];
                                                ?>
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
                            @if ($accident->acc_status == 1)
                                <a href="{{ route('staff.accident.delete', $accident->acc_id) }}"
                                    onclick="return confirm('{{ __('confirmDelete') }}')"
                                    class="btn btn-lg bg-danger text-white w-100 text-nowrap m-1"
                                    style="max-width: 400px;">{{ __('delete') }}</a>
                                <a href="{{ route('staff.accident.report', $accident->acc_id) }}"
                                    class="btn btn-lg bg-olive text-white w-100 text-nowrap m-1"
                                    style="max-width: 400px;">{{ __('report') }}</a>
                            @endif
                            <a href="{{ route('staff.accident.edit', $accident->acc_id) }}"
                                class="btn btn-lg bg-warning text-white w-100 text-nowrap m-1"
                                style="max-width: 400px;">{{ __('edit') }}</a>

                            <a class="btn btn-lg bg-olive text-white w-100 text-nowrap m-1" style="max-width: 400px;"
                                href="{{ route('staff.accident.index') }}">{{ __('back') }}</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
@stop

@section('js')
@stop
