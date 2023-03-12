@extends('layouts.master2')

@section('title', 'Track')

@section('heading')
    {{ __('trackReports') }}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a class="btn bg-olive text-white w-100" href="{{ route('staff.track.create') }}"><i class="fa fa-plus-circle"></i> {{ __('newReport') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body  p-1">
                        <!-- form start -->
                        {{-- <form class="form-horizontal" action="{{ route('staff.track.search') }}" method="post"
                            id="track-search">
                            @csrf
                            <div class="form-group row">
                                <label for="date" class="col-2 col-lg-2 col-form-label">{{ __('date') }}</label>
                                <div class="col-6 col-lg-3">
                                    <input type="date" class="form-control" id="date" name="date">
                                </div>
                                <div class="col-4 col-lg-1">
                                    <button type="submit"
                                        class="btn bg-olive text-white w-100">{{ __('search') }}</button>
                                </div>
                            </div>
                        </form><!-- /.form -->
                        <hr> --}}

                        <table id="search-table" class="table table-bordered table-striped">
                            <thead style="text-align:center">
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('information') }}</th>
                                    <th>{{ __('status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tracks as $track)
                                    <tr>
                                        <td style="text-align:center">
                                            <a href="{{ route('staff.track.show', $track->track_id) }}">{{ $track->track_id }}</a>
                                        </td>
                                        <td>
                                            <p class="text-bold">{{ $track->track_title }}</p>
                                            <ul class="text-sm">
                                                <li><strong>{{ __('date') }}:</strong> {{ $track->track_date }}</li>
                                                <li><strong>{{ __('time') }}:</strong> {{ $track->track_time }}</li>
                                                <li><strong>{{ __('place') }}:</strong> {{ $track->track_place }}</li>
                                            </ul>
                                            
                                        </td>
                                        <td style="text-align:center">{{ $track->track_status_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.card-body -->
                    <div class="card-footer d-flex justify-content-center">                            
                        <a class="btn btn-lg bg-olive text-white w-100 text-nowrap" style="max-width: 400px;" href="{{ route('staff.dashboard') }}">{{ __('back') }}</a>
                    </div>
                </div><!-- /.card card-primary -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
@stop

@section('js')
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
    <!-- Page specific script -->
    {{-- <script>
        $(function() {
            $('#track-search').validate({
                rules: {
                    date: {
                        required: true,
                    },
                },
                messages: {
                    date: {
                        required: "{{ __('selectDate') }}",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-8').append(error);

                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script> --}}

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
                "searching": true,
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
