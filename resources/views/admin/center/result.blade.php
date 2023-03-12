@extends('layouts.master')

@section('title', 'Center Management')

@section('heading')
    {{ __('centerManagement') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a href="{{ route('center.create') }}"><button type="button" class="btn bg-olive text-white w-100">{{ __('newCenter') }}</button></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('center.search') }}" method="post" id="center-search">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-xl-2 my-2">
                                    <input type="text" class="form-control" id="centerID" name="centerID" placeholder="{{ __('centerID') }}">
                                </div>
                                <div class="col-12 col-xl-2 my-2">
                                    <input type="text" class="form-control" id="centerName" name="centerName" placeholder="{{ __('centerName') }}">
                                </div>   
                                <div class="col-12 col-xl-2 my-2">
                                    <input type="text" class="form-control" id="address" name="address" placeholder="{{ __('address') }}">
                                </div> 
                                <div class="col-12 col-xl-2 my-2">
                                    <input type="text" class="form-control" id="telephone" name="telephone" placeholder="{{ __('telephone') }}">
                                </div>                              
                                <div class="col-12 col-xl-2 my-2">
                                    <button type="submit" class="btn bg-olive text-white w-100">{{ __('search') }}</button>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                        <table id="center-table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:10%;">
                                <col style="width:28%;">
                                <col style="width:36%;">
                                <col style="width:10%;">
                                <col style="width:8%;">
                                <col style="width:8%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th>{{ __('centerID') }}</th>
                                    <th>{{ __('centerName') }}</th>
                                    <th>{{ __('address') }}</th>
                                    <th>{{ __('telephone') }}</th>
                                    <th>{{ __('edit') }}</th>
                                    <th>{{ __('delete') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($centers as $center)
                                    <tr>
                                        <td style="text-align: center"><a href="{{ route('center.show', $center->centerId) }}">{{ $center->centerId }}</a></td>
                                        <td>{{ $center->centerName }}</td>
                                        <td>{{ $center->centerAddr }}</td>
                                        <td>{{ $center->centerTel }}</td>
                                        <td style="text-align: center">
                                            <a href="{{ route('center.edit', $center->centerId) }}">
                                                <button type="button" class="btn bg-olive text-white w-100">{{ __('edit') }}</button>
                                            </a>
                                        </td>
                                        <td>
                                            @if ($center->isDeleted == 0)
                                                <a href="{{ route('center.delete', $center->centerId) }}"
                                                    onclick="return confirm('{{ __('deleteCenter') }}')">
                                                    <button type="button" class="btn btn-block btn-danger" disabled>{{ __('delete') }}</button>
                                                </a>
                                            @else
                                                <a href="{{ route('center.recenter', $center->centerId) }}"
                                                    onclick="return confirm('{{ __('restoreCenter') }}')">
                                                    <button type="button"
                                                        class="btn bg-olive text-white w-100" disabled>Restore</button>
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
            $("#center-table").DataTable({
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
            }).buttons().container().appendTo('#center-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
