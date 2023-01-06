@extends('layouts.master')

@section('title', 'Accident Information')

@section('heading')
    {{ __('accidentReports') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h2 class="card-title text-bold text-lg">{{ __('accidentReports') }}</h2>
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
                        <hr>

                        <div>
                            <label>営業所への報告</label>
                            <p>1. 営業所への一報</p>
                            <p>&ensp; 拠点長もしくは運行管理者に連絡。事故の一報を入れる。</p>
                        </div>
                        <div>
                            <p>2. 相手方の確認</p>
                            <table class="table table-striped projects p-0 m-0">
                                <tbody>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('name') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accidentPeople->acc_involved_people_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('address') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accidentPeople->acc_involved_people_addr }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('contact') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accidentPeople->acc_involved_people_contact }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('telephone') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accidentPeople->acc_involved_people_tel }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('company') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accidentPeople->acc_involved_people_company }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <p>※相手が建物、電柱、フェンスなどの器物の場合</p>
                            <table class="table table-striped projects p-0 m-0">
                                <tbody>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('name') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accidentPeople->acc_involved_people_other }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('contact') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accidentPeople->acc_involved_people_other_contact }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>

                        <div>
                            <p>3. ①相手方の車の確認</p>
                            <table class="table table-striped projects p-0 m-0">
                                <tbody>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('carNumberPalette') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accidentCar->car_number_palette }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('carType') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accidentCar->car_type }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('carColor') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accidentCar->car_color }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('carImage') }}
                                        </td>
                                        <td style="width: 70%">
                                            @if (isset($accidentCarMedias))
                                                <?php $i = 1; ?>
                                                @foreach ($accidentCarMedias as $accidentCarMedia)
                                                    <a href="/storage/{{ $accidentCarMedia->car_media_url }}"
                                                        target="_blank"><img src="/img/file.png"
                                                            style="width:30px; height:30x">File Attachment
                                                        {{ $i++ }}&nbsp&nbsp&nbsp</a>
                                                    <br>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('carSpeed') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accidentCar->car_speed }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('carRepairGarageAddress') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accidentCar->car_repair_garage }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('carRepairGarageTel') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accidentCar->car_repair_garage_tel }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>

                            <p>②自車の確認</p>
                            <table class="table table-striped projects p-0 m-0">
                                <tbody>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('carSpeed') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accident->our_truck_speed }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('carRepairGarageAddress') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accident->our_truck_repair_garage_addr }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('carRepairGarageTel') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accident->our_truck_repair_garage_tel }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <hr>

                        <div>
                            <p>4. 相手方の保険会社の確認</p>
                            <table class="table table-striped projects p-0 m-0">
                                <tbody>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('insuranceCompanyName') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accidentPeople->acc_involved_people_insurance_company }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('insuranceNumber') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accidentPeople->acc_involved_people_insurance_number }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('insuranceImage') }}
                                        </td>
                                        <td style="width: 70%">
                                            @if (isset($accidentPeopleMedias))
                                                <?php $i = 1; ?>
                                                @foreach ($accidentPeopleMedias as $accidentPeopleMedia)
                                                    <a href="/storage/{{ $accidentPeopleMedia->insurance_media_url }}"
                                                        target="_blank"><img src="/img/file.png"
                                                            style="width:30px; height:30x">File Attachment
                                                        {{ $i++ }}&nbsp&nbsp&nbsp</a>
                                                    <br>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <p>※その場で相手と示談交渉はしない。陳謝は良いが必ず事故係から連絡させる事を相手に伝える。</p>
                        </div>
                        <hr>
                        <br>

                        <div>
                            <p>5. 事故の状況と情報収集を図る</p>
                            <table class="table table-striped projects p-0 m-0">
                                <tbody>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('roadType') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accident->road_type_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('roadWidth') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accident->onsite_road_width }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('outlook') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accident->onsite_outlook }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('trafficSign') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accident->onsite_traffic_signs }}
                                        </td>
                                    </tr>
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
                                            {{ __('collisionPoint') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accident->onsite_collision_point }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('parkPosition') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accident->onsite_park_position }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('victim') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accident->onsite_victim }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('witness') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accident->onsite_witness }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('content') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accident->acc_content }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('status') }}
                                        </td>
                                        <td style="width: 70%">
                                            {{ $accident->track_status_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold" style="width: 30%">
                                            {{ __('accidentImage') }}
                                        </td>
                                        <td style="width: 70%">
                                            @if (isset($accidentMedias))
                                                <?php $i = 1; ?>
                                                @foreach ($accidentMedias as $accidentMedia)
                                                    <a href="/storage/{{ $accidentMedia->acc_media_url }}"
                                                        target="_blank"><img src="/img/file.png"
                                                            style="width:30px; height:30x">File Attachment
                                                        {{ $i++ }}&nbsp&nbsp&nbsp</a>
                                                    <br>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <hr>

                        <div>
                            <p>6. 営業所への再度連絡</p>
                            <p>2～5までの内容が確認出来たら、再度拠点長もしくは運行管理者に連絡</p>
                        </div>
                        <hr>

                        <div>
                            <p>7. 医師の診察を受ける</p>
                            <p>軽いけがだと思ったり、自覚症状がなくても必ず医師の診断を受ける。領収書や診断書は保存しておく。</p>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-3 col-md-2">
                                <a href="{{ route('staff.accident.delete', $accident->acc_id) }}"
                                    onclick="return confirm('- この店舗を削除しますか?:')"><button type="button"
                                        class="btn bg-danger text-white w-100 m-1"
                                        disabled="">{{ __('delete') }}</button></a>
                            </div>
                            <div class="col-3 col-md-2">
                                <a href="{{ route('staff.accident.edit', $accident->acc_id) }}"><button type="button"
                                        class="btn bg-olive text-white w-100 m-1">{{ __('edit') }}</button></a>
                            </div>
                            @if ($accident->acc_status == 1)
                                <div class="col-3 col-md-2">
                                    <a href="{{ route('staff.accident.report', $accident->acc_id) }}"><button
                                            type="button"
                                            class="btn bg-olive text-white w-100 m-1">{{ __('report') }}</button></a>
                                </div>
                            @endif
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@stop

@section('js')
@stop
