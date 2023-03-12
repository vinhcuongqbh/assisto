@extends('layouts.master2')

@section('title', 'Track Create')

@section('heading')
    {{ __('trackReports') }}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold text-lg">{{ __('trackReports') }}</h3>
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
                    <form action="{{ route('staff.track.store') }}" method="post" id="track-create"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-12 col-md-2 col-form-label">{{ __('date') }}</label>
                                <div class="col-12 col-md-10">
                                    <input type="date" class="form-control" id="date" name="date"
                                        value="{{ old('date') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-md-2 col-form-label">{{ __('time') }}</label>
                                <div class="col-12 col-md-10">
                                    <input type="time" class="form-control" id="time" name="time"
                                        value="{{ old('time') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-md-2 col-form-label">{{ __('place') }}</label>
                                <div class="col-12 col-md-10">
                                    <input type="text" class="form-control" id="place" name="place"
                                        value="{{ old('place') }}">
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
                                                    @if (old('classify') == $trackReportType->track_type_id) checked @endif>
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
                                        value="{{ old('title') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-md-2 col-form-label">{{ __('content') }}</label>
                                <div class="col-12 col-md-10">
                                    <textarea class="form-control" id="content" name="content" rows="4" cols="50">{{ old('content') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-md-2 col-form-label">{{ __('attachment') }}</label>
                                <div class="col-12 col-md-10">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="files[]" multiple />
                                            <label class="custom-file-label" for="inputFile">{{ __('chooseFile') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-center">
                            <button type="submit" name="action" value="report"
                                class="btn btn-lg bg-olive text-white w-100 text-nowrap m-1"
                                style="max-width: 400px;">{{ __('report') }}</button>
                            <button type="submit" name="action" value="draft"
                                class="btn btn-lg btn-warning text-white w-100 text-nowrap m-1"
                                style="max-width: 400px;">{{ __('draft') }}</button>
                            <a class="btn btn-lg btn-danger text-white w-100 text-nowrap m-1" style="max-width: 400px;"
                                href="{{ route('staff.track.index') }}">{{ __('cancel') }}</a>
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
            $('#track-create').validate({
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
    </script>
@stop
