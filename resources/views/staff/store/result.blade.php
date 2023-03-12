@extends('layouts.master2')

@section('title', 'Store')

@section('heading')
    {{ __('storeInformation') }}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a class="btn bg-olive text-white w-100" href="{{ route('staff.store.create') }}"><i
                                        class="fa fa-plus"></i> {{ __('newStore') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body m-0 p-0">
                        <table id="result-table" class="table table-head-fixed table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center text-nowrap">{{ __('storeID') }}</th>
                                    <th class="text-center">{{ __('information') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stores as $store)
                                    <tr>
                                        <td class="text-center"><a
                                                href="{{ route('staff.store.show', $store->storeId) }}">{{ $store->storeId }}</a>
                                        </td>
                                        <td class="p-0 m-0">
                                            <table class="table table-borderless w-100">
                                                <tbody>
                                                    <tr>
                                                        <td class="pl-0"><strong>{{ $store->storeName }}</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-sm p-0"><strong>{{ __('address') }}:</strong>
                                                            {{ $store->storeAddr }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-sm p-0"><strong>{{ __('telephone') }}:</strong>
                                                            {{ $store->storeTel }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-sm p-0"><strong>{{ __('centerName') }}:</strong>
                                                            {{ $store->centerName }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex justify-content-center">
                        <a class="btn btn-lg bg-olive text-white w-100 text-nowrap" style="max-width: 400px;"
                            href="{{ route('staff.store') }}">{{ __('back') }}</a>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
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
            $("#result-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "pageLength": 30,
                "searching": false,
                "autoWidth": false,
                "ordering": false,
                "info": false,
                "paging": true,
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
