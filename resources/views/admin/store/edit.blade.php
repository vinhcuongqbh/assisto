@extends('layouts.master')

@section('title', 'Store Edit')

@section('heading')
    {{ __('storeManagement') }}
@stop

@section('content')
    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <style type="text/css">
        #the-canvas {
            padding: 10px;
            direction: ltr;
            width: 100%;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title text-bold">{{ __('storeInformation') }}</h3>
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
                    <form action="{{ route('store.update', $store->storeId) }}" method="post" id="store-edit"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="storeId">{{ __('storeID') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="storeId" name="storeId" value="{{ $store->storeId }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="storeName">{{ __('storeName') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="storeName" name="storeName" value="{{ $store->storeName }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="centerName">{{ __('centerName') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <select id="centerId" name="centerId" class="form-control custom-select">
                                        @foreach ($center as $i)
                                            <option value="{{ $i->centerId }}"
                                                @if ($i->centerId == $store->centerId) {{ 'selected' }} @endif>
                                                {{ $i->centerName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="address">{{ __('address') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="address" id="address" name="address" value="{{ $store->storeAddr }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="workTime">{{ __('workTime') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="workTime" name="workTime"
                                        value="{{ $store->storeWorkTime }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="tel">{{ __('telephone') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="tel" name="tel" value="{{ $store->storeTel }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="password">{{ __('doorPassword') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="password" name="password"
                                        value="{{ $store->storePassword }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="parkPos">{{ __('parkPosition') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="parkPos" name="parkPos"
                                        value="{{ $store->storeParkPosition }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="delivery">{{ __('deliveryType') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="delivery" name="delivery"
                                        value="{{ $store->asahiDeliveryMethod }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="add1">{{ __('addtionally1') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="add1" name="add1"
                                        value="{{ $store->asahiSupplement1 }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="add2">{{ __('addtionally2') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="add2" name="add2"
                                        value="{{ $store->asahiSupplement2 }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="comment">{{ __('comment') }}</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea id="comment" name="comment" class="form-control">{{ $store->comment }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">                                               
                                <div class="col-sm-3">
                                    <label for="guideFile">{{ __('guideFile') }}</label>
                                </div>               
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputFile"
                                                name="inputFile" accept="application/pdf">
                                            <label class="custom-file-label"
                                                for="inputFile">{{ __('chooseFile') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    @if (isset($store->storePdfLink))
                                        <div class="col-12"><canvas id="the-canvas"></canvas></div>
                                        {{-- <span hidden id="page_count"></span> --}}
                                        <div class="col-12" style="padding: 5px 10px 10px 10px; text-align: center;">
                                            <button type="button" class="btn btn-outline-default" id="prev">
                                                {{ __('previous') }}</button>&ensp;
                                            <input id="page_num" value="" onchange="onOfPage(this);"
                                                style="width: 40px; text-align: right;" /> / <span
                                                id="page_count"></span>&ensp;
                                            <button type="button" class="btn btn-outline-default"
                                                id="next">{{ __('next') }}</button>
                                        </div>
                                        <?php
                                        //Khai báo biến lấy nội dung file và encode base64
                                        $getPDF = base64_encode(file_get_contents('storage/' . $store->storePdfLink));
                                        ?>
                                    @endif
                                </div>  
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-center">
                            <button type="submit"
                                class="btn btn-warning w-100 text-nowrap m-1">{{ __('update') }}</button>
                            <button onclick="javascript:history.back()"
                                class="btn bg-olive text-white w-100 text-nowrap m-1">{{ __('back') }}</button>
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
            $('#store-edit').validate({
                rules: {
                    storeId: {
                        required: true,
                    },
                    centerId: {
                        required: true,
                    },
                    storeName: {
                        required: true,
                    },
                },
                messages: {
                    storeId: {
                        required: "{{ __('enterStoreID') }}",
                    },
                    centerId: {
                        required: "{{ __('selectCenterName') }}",
                    },
                    storeName: {
                        required: "{{ __('enterStoreName') }}"
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-sm-9').append(error);

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

    <script type="text/javascript">
        var pdfData = atob('<?php echo $getPDF; ?>');

        var pdfjsLib = window['pdfjs-dist/build/pdf'];

        pdfjsLib.GlobalWorkerOptions.workerSrc = "//mozilla.github.io/pdf.js/build/pdf.worker.js";

        var pdfDoc = null,
            pageNum = 1,
            pageRendering = false,
            pageNumPending = null,
            scale = 1.2,
            canvas = document.getElementById('the-canvas'),
            ctx = canvas.getContext('2d');
        canvas.oncontextmenu = function() {
            return false
        };
        var loadingTask = pdfjsLib.getDocument({
            data: pdfData
        });
        loadingTask.promise.then(function(pdf) {
            pdfDoc = pdf;
            document.getElementById('page_count').textContent = pdf.numPages;
            renderPage(pageNum);
        }, function(reason) {
            console.error(reason);
        });

        function renderPage(num) {
            pageRendering = true;
            pdfDoc.getPage(num).then(function(page) {
                var viewport = page.getViewport({
                    scale: scale
                });
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);
                renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });
            document.getElementById('page_num').value = num;
        }

        function queueRenderPage(num) {
            if (pageRendering)
                pageNumPending = num;
            else
                renderPage(num);
        }

        function onPrevPage() {
            if (pageNum <= 1)
                return;
            pageNum--;
            queueRenderPage(pageNum);
        }
        document.getElementById('prev').addEventListener('click', onPrevPage);

        function onNextPage() {
            if (pageNum >= pdfDoc.numPages)
                return;
            pageNum++;
            queueRenderPage(pageNum);
        }
        document.getElementById('next').addEventListener('click', onNextPage);

        function onOfPage(e) {
            var num = parseInt(e.value);
            if (Number.isInteger(num) == false)
                return;
            if (num > pdfDoc.numPages || num < 1)
                return;
            pageNum = num;
            queueRenderPage(pageNum);
        }
    </script>
@stop
