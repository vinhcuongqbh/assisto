@extends('layouts.master2')

@section('title', 'Route')

@section('heading')
    {{ __('route') }}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('schedule') }}</h3>
                    </div>
                    <!-- form start -->
                    <form class="form-horizontal" action="{{ route('staff.route.result') }}" method="post" id="route-search">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="date" class="col-2 col-lg-2 col-form-label">{{ __('dateDelivery') }}</label>
                                <div class="col-6 col-lg-3">
                                    <input type="date" class="form-control" id="date" name="date"
                                        value="{{ $date }}">
                                </div>
                                <div class="col-4 col-lg-1">
                                    <button type="submit" class="btn bg-olive text-white w-100">{{ __('search') }}</button>
                                </div>
                            </div>
                            <hr>
                            <table id="search-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">{{ __('storeID') }}</th>
                                        <th style="text-align: center">{{ __('typeBusiness') }}</th>
                                        <th style="text-align: center">{{ __('course') }}</th>
                                        <th style="text-align: center">{{ __('storeName') }}</th>
                                        <th style="text-align: center">{{ __('telephone') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($routes as $route)
                                        <tr>
                                            <td>
                                                <a href="{{ route('staff.store.show', $route->storeId) }}">{{ $route->storeId }}</a>
                                            </td>
                                            <td>{{ $route->storeType }}</td>
                                            <td>{{ $route->course }}</td>
                                            <td>{{ $route->storeName }}</td>
                                            <td>{{ $route->storeTel }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                    </form><!-- /.form -->
                </div><!-- /.card card-primary -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('js')
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $('#route-search').validate({
                rules: {
                    date: {
                        required: true,
                    },
                },
                messages: {
                    date: {
                        required: "You must enter Date",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-sm-10').append(error);

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
            $("#search-table").DataTable({
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
