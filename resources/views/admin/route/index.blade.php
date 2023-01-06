@extends('layouts.master')

@section('title', 'Route Management')

@section('Heading')
    {{ __('routeManagement') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a href="{{ route('route.create') }}"><button type="button"
                                        class="btn bg-olive text-white w-100">{{ __('newRoute') }}</button></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="route-table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:10%;">
                                <col style="width:10%;">
                                <col style="width:25%;">
                                <col style="width:20%;">
                                <col style="width:19%;">
                                <col style="width:8%;">
                                <col style="width:8%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th>{{ __('routeID') }}</th>
                                    <th>{{ __('dateDelivery') }}</th>
                                    <th>{{ __('staffName') }}</th>
                                    <th>{{ __('course') }}</th>
                                    <th>{{ __('storeName') }}</th>
                                    <th>{{ __('edit') }}</th>
                                    <th>{{ __('delete') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($routes as $route)
                                    <tr>
                                        <td style="text-align: route"><a
                                                href="{{ route('route.show', $route->routeId) }}">{{ $route->routeId }}</a>
                                        </td>
                                        <td>{{ $route->routeDate }}</td>
                                        <td>{{ $route->name }}</td>
                                        <td>{{ $route->course }}</td>
                                        <td>{{ $route->storeName }}</td>
                                        <td style="text-align: route">
                                            <a href="{{ route('route.edit', $route->routeId) }}">
                                                <button type="button"
                                                    class="btn bg-olive text-white w-100">{{ __('edit') }}</button>
                                            </a>
                                        </td>
                                        <td>
                                            @if ($route->isDeleted == 0)
                                                <a href="{{ route('route.delete', $route->routeId) }}"
                                                    onclick="return confirm('{{ __('deleteRoute') }}')">
                                                    <button type="button" class="btn btn-block btn-danger"
                                                        disabled>{{ __('delete') }}</button>
                                                </a>
                                            @else
                                                <a href="{{ route('route.restore', $route->routeId) }}"
                                                    onclick="return confirm('{{ __('restoreRoute') }}')">
                                                    <button type="button" class="btn bg-olive text-white w-100"
                                                        disabled>{{ __('restore') }}</button>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
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
        $(function() {
            $("#route-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "pageLength": 25,
                "searching": true,
                "autoWidth": false,
                "ordering": false,
                "buttons": ["copy", "excel", "pdf", "print"],
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
            }).buttons().container().appendTo('#route-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
