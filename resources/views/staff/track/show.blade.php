@extends('layouts.master2')

@section('title', 'Track Report')

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
                                    <td class="text-bold">
                                        {{ __('attachment') }}
                                    </td>
                                    <td>
                                        @if (isset($trackReportMedias))
                                            <?php $i = 1; ?>
                                            @foreach ($trackReportMedias as $trackReportMedia)
                                                <a href="/storage/{{ $trackReportMedia->track_report_media_url }}"
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
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="form-group row justify-content-end">
                            <div class="col-3 col-md-2">
                                <a href="{{ route('staff.track.delete', $track->track_id) }}"
                                    onclick="return confirm('- この店舗を削除しますか?:')"><button type="button"
                                        class="btn bg-danger text-white w-100 text-nowrap"
                                        disabled="">{{ __('delete') }}</button></a>
                            </div>
                            <div class="col-3 col-md-2">
                                <a href="{{ route('staff.track.edit', $track->track_id) }}"><button type="button"
                                        class="btn bg-olive text-white w-100 text-nowrap">{{ __('edit') }}</button></a>
                            </div>
                            @if ($track->track_status == 1)
                                <div class="col-3 col-md-2">
                                    <a href="{{ route('staff.track.report', $track->track_id) }}"><button type="button"
                                            class="btn bg-olive text-white w-100 text-nowrap">{{ __('report') }}</button></a>
                                </div>
                            @endif
                            <div class="col-3 col-md-2">
                                <button class="btn bg-olive text-white w-100 text-nowrap"><a
                                    href="{{ route('staff.track.index') }}">{{ __('back') }}</a></button>
                            </div>
                        </div>
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
