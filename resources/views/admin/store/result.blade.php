@extends('layouts.master')

@section('title', 'Store Management')

@section('heading')
    {{ __('storeManagement') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a href="{{ route('store.create') }}"><button type="button"
                                        class="btn bg-olive text-white w-100">{{ __('newStore') }}</button></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('store.search') }}" method="post" id="store-search">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-xl-2 my-2">
                                    <input type="text" class="form-control" id="storeID" name="storeID"
                                        placeholder="{{ __('storeID') }}">
                                </div>
                                <div class="col-12 col-xl-2 my-2">
                                    <input type="text" class="form-control" id="storeName" name="storeName"
                                        placeholder="{{ __('storeName') }}">
                                </div>
                                <div class="col-12 col-xl-2 my-2">
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="{{ __('address') }}">
                                </div>
                                <div class="col-12 col-xl-2 my-2">
                                    <input type="text" class="form-control" id="telephone" name="telephone"
                                        placeholder="{{ __('telephone') }}">
                                </div>
                                <div class="col-12 col-xl-2 my-2">
                                    <input type="text" class="form-control" id="centerName" name="centerID"
                                        placeholder="{{ __('centerName') }}">
                                </div>
                                <div class="col-12 col-xl-2 my-2">
                                    <button type="submit"
                                        class="btn bg-olive text-white w-100">{{ __('search') }}</button>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                        <table id="store-table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:8%;">
                                <col style="width:20%;">
                                <col style="width:33%;">
                                <col style="width:10%;">
                                <col style="width:20%;">
                                <col style="width:8%;">
                                <col style="width:8%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th>{{ __('storeID') }}</th>
                                    <th>{{ __('storeName') }}</th>
                                    <th>{{ __('address') }}</th>
                                    <th>{{ __('telephone') }}</th>
                                    <th>{{ __('centerName') }}</th>
                                    <th>{{ __('edit') }}</th>
                                    <th>{{ __('delete') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stores as $store)
                                    <tr>
                                        <td style="text-align: center"><a
                                                href="{{ route('store.show', $store->storeId) }}">{{ $store->storeId }}</a>
                                        </td>
                                        <td>{{ $store->storeName }}</td>
                                        <td>{{ $store->storeAddr }}</td>
                                        <td>{{ $store->storeTel }}</td>
                                        <td>{{ $store->centerName }}</td>
                                        <td style="text-align: center">
                                            <a href="{{ route('store.edit', $store->storeId) }}">
                                                <button type="button"
                                                    class="btn bg-olive text-white w-100">{{ __('edit') }}</button>
                                            </a>
                                        </td>
                                        <td>
                                            @if ($store->isDeleted == 0)
                                                <a href="{{ route('store.delete', $store->storeId) }}"
                                                    onclick="return confirm('{{ __('deleteStore') }}')">
                                                    <button type="button"
                                                        class="btn btn-block btn-danger">{{ __('delete') }}</button>
                                                </a>
                                            @else
                                                <a href="{{ route('store.restore', $store->storeId) }}"
                                                    onclick="return confirm('{{ __('restoreStore') }}')">
                                                    <button type="button"
                                                        class="btn bg-olive text-white w-100">{{ __('restore') }}</button>
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
            $("#store-table").DataTable({
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
            }).buttons().container().appendTo('#store-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
