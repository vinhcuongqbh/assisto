@extends('layouts.master2')

@section('title', 'Track Report')

@section('heading')
    {{ __('trackReports') }}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h2 class="card-title text-bold text-lg">{{ __('trackReports') }}</h2>
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
                    <div class="card-body p-0 m-0">
                        <table class="table table-striped projects p-0 m-0">
                            <tbody>
                                <tr>
                                    <td class="text-bold" style="width: 30%">
                                        {{ __('trackID') }}
                                    </td>
                                    <td style="width: 70%">
                                        {{ $track->track_id }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold" style="width: 30%">
                                        {{ __('date') }}
                                    </td>
                                    <td style="width: 70%">
                                        {{ $track->track_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('time') }}
                                    </td>
                                    <td>
                                        {{ $track->track_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('place') }}
                                    </td>
                                    <td>
                                        {{ $track->track_place }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('classify') }}
                                    </td>
                                    <td>
                                        {{ $track->track_type_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('title') }}
                                    </td>
                                    <td>
                                        {{ $track->track_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('content') }}
                                    </td>
                                    <td>
                                        {{ $track->track_content }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('trackStatus') }}
                                    </td>
                                    <td>
                                        {{ $track->track_status_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold" colspan="2">
                                        {{ __('attachment') }}

                                        @if (isset($trackReportMedias))
                                            <?php
                                            $img = ['jpg', 'jpeg', 'png', 'bmp'];
                                            ?>
                                            <div style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 10px;">
                                                @foreach ($trackReportMedias as $trackReportMedia)
                                                    @if (in_array(substr($trackReportMedia->track_report_media_url, -3), $img))
                                                        <div>
                                                            <img style="width:
                                                                100%"
                                                                src="/storage/{{ $trackReportMedia->track_report_media_url }}">
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold" colspan="2">
                                        @if (isset($trackReportMedias))
                                            <?php
                                            $img = ['jpg', 'jpeg', 'png', 'bmp'];
                                            ?>
                                            <div>
                                                @foreach ($trackReportMedias as $trackReportMedia)
                                                    @if (!in_array(substr($trackReportMedia->track_report_media_url, -3), $img))
                                                        <div>
                                                            <a href="/storage/{{ $trackReportMedia->track_report_media_url }}"
                                                                target="_blank"><img src="/img/file.png"
                                                                    style="width:30px; height:30x">{{ substr($trackReportMedia->track_report_media_url, strlen('File/')) }}</a>
                                                            <br>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex justify-content-center">
                        @if ($track->track_status == 1)
                            <a class="w-100 m-1" href="{{ route('staff.track.delete', $track->track_id) }}"
                                onclick="return confirm('- この店舗を削除しますか?:')"><button type="button"
                                    class="btn bg-danger text-white text-nowrap w-100 btn-lg">{{ __('delete') }}</button></a>
                            <a class="btn bg-olive text-white text-nowrap w-100 btn-lg m-1"
                                href="{{ route('staff.track.report', $track->track_id) }}">{{ __('report') }}</a>
                        @endif

                        <a class="btn bg-warning text-white text-nowrap w-100 btn-lg m-1"
                            href="{{ route('staff.track.edit', $track->track_id) }}">{{ __('edit') }}</a> <a
                            class="btn bg-olive text-white text-nowrap w-100 btn-lg m-1"
                            href="{{ route('staff.track.index') }}">{{ __('back') }}</a>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@stop

@section('js')
@stop
