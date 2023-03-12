@extends('layouts.master2')

@section('title', 'Store Information')

@section('heading')
    {{ __('storeInformation') }}
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
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h2 class="card-title text-bold text-lg">{{ __('storeInformation') }}</h2>
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
                                        ULR
                                    </td>
                                    <td style="width: 70%">
                                        <div class="input-group">
                                            <input id="asaboUrl" type="text" class="form-control"
                                                   value="https://asabo.net/staff/store/{{ $store->storeId }}/show" disabled="true">
                                            <span class="input-group-append">
                                                <button onclick="copyText()" class="btn btn-info btn-sm">Copy</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold" style="width: 30%">
                                        {{ __('storeID') }}
                                    </td>
                                    <td style="width: 70%">
                                        {{ $store->storeId }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('storeName') }}
                                    </td>
                                    <td>
                                        {{ $store->storeName }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('address') }}
                                    </td>
                                    <td>
                                        {{ $store->storeAddr }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('workTime') }}
                                    </td>
                                    <td>
                                        {{ $store->storeWorkTime }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('telephone') }}
                                    </td>
                                    <td>
                                        {{ $store->storeTel }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('centerName') }}
                                    </td>
                                    <td>
                                        {{ $store->centerName }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('doorPassword') }}
                                    </td>
                                    <td>
                                        {{ $store->storePassword }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('parkPosition') }}
                                    </td>
                                    <td>
                                        {{ $store->storeParkPosition }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('deliveryType') }}
                                    </td>
                                    <td>
                                        {{ $store->asahiDeliveryMethod }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('addtionally1') }}
                                    </td>
                                    <td>
                                        {{ $store->asahiSupplement1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('addtionally2') }}
                                    </td>
                                    <td>
                                        {{ $store->asahiSupplement2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ __('comment') }}
                                    </td>
                                    <td>
                                        {{ $store->comment }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="form-group row m-0 p-0">
                            @if (isset($store))
                                <div class="col-12"><canvas id="the-canvas"></canvas></div>
                                {{-- <span hidden id="page_count"></span> --}}
                                <div class="col-12" style="padding: 5px 10px 10px 10px; text-align: center;">
                                    <button type="button" class="btn btn-outline-default" id="prev">
                                        {{ __('previous') }}</button>&ensp;
                                    <input id="page_num" value="" onchange="onOfPage(this);"
                                        style="width: 40px; text-align: right;" /> / <span id="page_count"></span>&ensp;
                                    <button type="button" class="btn btn-outline-default"
                                        id="next">{{ __('next') }}</button>
                                </div>
                                <?php
                                //Khai báo biến lấy nội dung file và encode base64
                                if ($store->storePdfLink != null) {
                                    $getPDF = base64_encode(file_get_contents('storage/' . $store->storePdfLink));
                                } else {
                                    $getPDF = '0';
                                }
                                ?>
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex justify-content-center">
                        <a class="btn btn-lg btn-danger text-white w-100 text-nowrap m-1"
                            href="{{ route('staff.store.delete', $store->storeId) }}"onclick="return confirm('- この店舗を削除しますか?:')">{{ __('delete') }}</a>
                        <a class="btn btn-lg btn-warning text-white w-100 text-nowrap m-1"
                            href="{{ route('staff.store.edit', $store->storeId) }}">{{ __('edit') }}</a>
                        <button onclick="javascript:history.back()"
                            class="btn btn-lg bg-olive text-white w-100 text-nowrap m-1">{{ __('back') }}</button>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@stop

@section('js')
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

        function copyText() {
            const userAgent = navigator.userAgent;
            if(/Asabo/i.test(userAgent)){
                var copyText = document.getElementById("asaboUrl");
                NativeAndroid.copyToClipboard(copyText.value);
                alert("「" + copyText.value + "」URLをコピーしました");
            }else{
                // Get the text field
                var copyText = document.getElementById("asaboUrl");

                // Select the text field
                copyText.select();
                copyText.setSelectionRange(0, 99999); // For mobile devices

                // Copy the text inside the text field
                navigator.clipboard.writeText(copyText.value);

                // Alert the copied text
                alert("「" + copyText.value + "」URLをコピーしました");
            }
        }
    </script>
@stop

@section('css')
@stop
