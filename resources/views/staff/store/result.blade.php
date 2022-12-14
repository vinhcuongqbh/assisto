@extends('layouts.master2')

@section('title', 'Store')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a href="{{ route('staff.store.create') }}"><button type="button"
                                        class="btn bg-olive text-white w-100">{{ __('newStore') }}</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="result-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align: center">{{ __('storeID') }}</th>
                                        <th style="text-align: center">{{ __('storeName') }}</th>
                                        <th style="text-align: center">{{ __('address') }}</th>
                                        <th style="text-align: center">{{ __('telephone') }}</th>
                                        <th style="text-align: center">{{ __('centerName') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stores as $store)
                                    <tr>
                                        <td style="text-align: center"><a href="{{ route('staff.store.show', $store->storeId) }}">{{ $store->storeId }}</a></td>
                                        <td>{{ $store->storeName }}</td>
                                        <td>{{ $store->storeAddr }}</td>
                                        <td>{{ $store->storeTel }}</td>
                                        <td>{{ $store->centerId }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="form-group row justify-content-end">                            
                            <div class="col-3 col-md-2">
                                <button class="btn bg-olive text-white w-100 text-nowrap"><a href="{{ route('staff.store') }}">{{ __('back') }}</a></button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
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
            "pageLength": 25,
            "searching": false,
            "autoWidth": false,
            "ordering": false,
            "info": false,
            "paging": false,
            //"buttons": ["copy", "excel", "pdf", "print"],
            // "language": {
            //     "search": "T??m ki???m:",
            //     "emptyTable": "Kh??ng c?? d??? li???u ph?? h???p",
            //     "zeroRecords": "Kh??ng t??m th???y d??? li???u ph?? h???p",
            //     "info": "Hi???n th??? _START_ - _END_ trong t???ng _TOTAL_ k???t qu???",
            //     "infoEmpty": "",
            //     "infoFiltered": "(T??m ki???m trong t???ng _MAX_ b???n ghi)",
            //     "paginate": {
            //         "first": "?????u ti??n",
            //         "last": "Cu???i c??ng",
            //         "next": "Sau",
            //         "previous": "Tr?????c"
            //     },
            // },
        }).buttons().container().appendTo('#store-table_wrapper .col-md-6:eq(0)');
    });
</script>
@stop
