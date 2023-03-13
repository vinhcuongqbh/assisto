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
                    <form action="{{ route('staff.track.update', $track->track_id) }}" method="post" id="track-edit"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-12 col-md-2 col-form-label">{{ __('trackID') }}</label>
                                <div class="col-12 col-md-10">
                                    <p class="form-control">{{ $track->track_id }} </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-md-2 col-form-label">{{ __('date') }}</label>
                                <div class="col-12 col-md-10">
                                    <input type="date" class="form-control" id="date" name="date"
                                        value="{{ $track->track_date }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-md-2 col-form-label">{{ __('time') }}</label>
                                <div class="col-12 col-md-10">
                                    <input type="time" class="form-control" id="time" name="time"
                                        value="{{ $track->track_time }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-md-2 col-form-label">{{ __('place') }}</label>
                                <div class="col-12 col-md-10">
                                    <input type="text" class="form-control" id="place" name="place"
                                        value="{{ $track->track_place }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-md-2 col-form-label">{{ __('classify') }}</label>
                                <div class="col-12 col-md-10">
                                    @foreach ($trackReportTypes as $trackReportType)
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="classify"
                                                    id="{{ $trackReportType->track_type_id }}"
                                                    value="{{ $trackReportType->track_type_id }}"
                                                    @if ($trackReportType->track_type_id == $track->track_type_id) checked @endif">
                                                <label
                                                    class="form-check-label">{{ $trackReportType->track_type_name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-md-2 col-form-label">{{ __('title') }}</label>
                                <div class="col-12 col-md-10">
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $track->track_title }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-md-2 col-form-label">{{ __('content') }}</label>
                                <div class="col-12 col-md-10">
                                    <textarea class="form-control" id="content" name="content" rows="4" cols="50">{{ $track->track_title }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-md-2 col-form-label">{{ __('attachment') }}</label>
                                <div class="col-12 col-md-10">
                                    <a id="cameraButton" class="btn btn-success mb-1 hide-on-desktop" href='javascript:;' onclick='takePicture();'><i class="fa fa-video"></i> 写真を撮る</a>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="files[]" multiple />
                                            <label class="custom-file-label" for="inputFile">{{ __('chooseFile') }}</label>
                                        </div>
                                    </div>
                                    <br>
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
                                                        <a
                                                            href="{{ route('track.deletefile', $trackReportMedia->track_report_media_id) }}"><button
                                                                type="button" class="btn btn-sm bg-danger"
                                                                style="float: right; margin-top: 5px">{{ __('delete') }}</button></a>

                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif

                                    <br>

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
                                                        <a
                                                            href="{{ route('track.deletefile', $trackReportMedia->track_report_media_id) }}"><button
                                                                type="button"
                                                                class="btn btn-sm bg-danger">{{ __('delete') }}</button></a>
                                                        <br>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-center">
                            @if ($track->track_status == 1)
                                <button type="submit" name="action" value="draft"
                                    class="btn btn-lg btn-warning text-white w-100 text-nowrap m-1"
                                    style="max-width: 400px;">{{ __('draft') }}</button>
                            @endif
                            <button type="submit" name="action" value="report"
                                class="btn btn-lg bg-olive text-white w-100 text-nowrap m-1"
                                style="max-width: 400px;">{{ __('report') }}</button>
                            <a class="btn btn-lg bg-olive text-white w-100 text-nowrap m-1" style="max-width: 400px;"
                                href="{{ route('staff.track.show', $track->track_id) }}">{{ __('back') }}</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
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
            $('#track-edit').validate({
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
        function takePicture() {
            NativeAndroid.takePicture();
        }
    </script>
@stop
