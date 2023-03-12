@extends('layouts.master')

@section('title', 'Dashboard')

@section('heading')
{{ __('dashboard') }}
@stop

@section('content')    
<div class="container-fluid">
    <div class="asabo-main-body">
        <div class="row">
            
            <div class="asabo-box">
                <div class="card card-default">
                    <div class="card-body" style="text-align:center">
                        <p class="text-center">{{ __('slogan') }}</p>
                        <b>{{ $setting->slogan }}</b>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a class="btn bg-olive text-white w-100 btn-lg" href="/admin/center">{{ __('centerManagement') }}</a>
                        </div>
                        <div class="form-group">
                            <a class="btn bg-olive text-white w-100 btn-lg" href="/admin/user">{{ __('userManagement') }}</a>
                        </div>
                        <div class="form-group">
                            <a class="btn bg-olive text-white w-100 btn-lg" href="/admin/store">{{ __('storeManagement') }}</a>
                        </div>
                        <div class="form-group">
                            <a class="btn bg-olive text-white w-100 btn-lg" href="/admin/accident">{{ __('accidentReports') }}</a>
                        </div>
                        <div class="form-group">
                            <a class="btn bg-olive text-white w-100 btn-lg" href="/admin/track">{{ __('trackReports') }}</a>
                        </div>
                        <div class="form-group">
                            <a class="btn bg-olive text-white w-100 btn-lg" href="/admin/setting/slogan">{{ __('slogan') }}</a>
                        </div>
                        <div class="form-group">
                            <a class="btn bg-olive text-white w-100 btn-lg" href="/admin/setting/guide">{{ __('guideManagement') }}</a>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn bg-olive text-white w-100 btn-lg" data-toggle="modal" data-target="#modal-android-qrcode">APK取得</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            
            <!-- add register modal -->
            <div class="modal fade" id="modal-android-qrcode">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>APK取得</h4>
                        </div>

                        <div class="modal-body">
                            <div class="col-md-12 items-center text-center">
                                <img  src="/img/asabo_qrcode.png"/>
                            </div>
                        </div><!-- modal-body -->

                        <div class="modal-footer">
                            <div class="input-group mb-3">
                                <input id="asaboUrl" type="text" class="form-control"
                                       value="https://asabo.net/apk/asabo.apk" disabled>
                                <div class="input-group-append">
                                    <a onclick="copyText()" class="btn btn-info"><i class="fas fa-copy"></i> Copy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@stop

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/vendor/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
@stop

@section('js')
<script src="/vendor/jquery/jquery.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/vendor/jszip/jszip.min.js"></script>
<script src="/vendor/pdfmake/pdfmake.min.js"></script>
<script src="/vendor/pdfmake/vfs_fonts.js"></script>
<script src="/vendor/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/vendor/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/vendor/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Page specific script -->
<script>
$(function () {
    $("#user-table").DataTable({
        "responsive": true,
        "lengthChange": false,
        "pageLength": 25,
        "searching": false,
        "autoWidth": false,
        "ordering": false,
        //"buttons": ["copy", "excel", "pdf", "print"],
        // "language": {
        //     "search": "Tìm kiếm:",
        //     "emptyTable": "Không có dữ liệu phù hợp",
        //     "zeroRecords": "Không tìm thấy dữ liệu phù hợp",
        //     "info": "Hiển thị _START_ - _END_ trong tổng _TOTAL_ kết quả",
        //     "infoEmpty": "",
        //     "infoFiltered": "(Tìm kiếm trong tổng _MAX_ bản ghi)",
        //     "paginate": {
        //         "first": "Đầu tiên",
        //         "last": "Cuối cùng",
        //         "next": "Sau",
        //         "previous": "Trước"
        //     },
        // },
    }).buttons().container().appendTo('#user-table_wrapper .col-md-6:eq(0)');
});
</script>
@stop
