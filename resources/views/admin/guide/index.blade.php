@extends('layouts.master')

@section('title', 'Guide File')

@section('heading')
    {{ __('guideManagement') }}
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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('guide.store') }}" method="post" id="guide-store" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="guideFile">{{ __('guideFile') }}</label>
                                </div>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="guideFile" name="guideFile"
                                                accept="application/pdf">
                                            <label class="custom-file-label" for="guideFile">{{ __('chooseFile') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit"
                                        class="btn bg-olive text-white w-100">{{ __('update') }}</button>
                                </div>
                                @if (isset($guide))
                                    <div class="col-sm-12">
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
                                        $getPDF = base64_encode(file_get_contents('storage/' . $guide->guide_file_url));
                                        ?>
                                    </div>
                                @else
                                    <?php
                                    //Khai báo biến lấy nội dung file và encode base64
                                    $getPDF = base64_encode('');
                                    ?>
                                @endif
                            </div>
                            <div class="form-group row justify-content-end">
                                
                            </div>
                        </div>
                        <!-- /.card-body -->
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
            $('#guide-store').validate({
                rules: {
                    guideFile: {
                        required: true,
                    },
                },
                messages: {
                    guideFile: {
                        required: "{{ __('selectFile') }}",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-sm-7').append(error);

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
