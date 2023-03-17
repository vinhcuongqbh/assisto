@extends('layouts.master')

@section('title', 'Track Report')

@section('heading')
    {{ __('trackReports') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-auto">
                <a href="{{ route('track.create') }}" class="btn bg-olive text-white w-100 text-nowrap"><i
                        class="fa fa-plus"></i> {{ __('newReport') }}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="search-table" class="table table-bordered bg-white">
                    <thead>
                        <tr>
                            <th style="text-align: center">ID</th>
                            <th style="text-align: center">{{ __('trackReports') }} {{ __('information') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tracks as $track)
                            <tr>
                                <td class="text-bold text-center">
                                    <a href="{{ route('track.show', $track->track_id) }}">{{ $track->track_id }}</a>
                                </td>
                                <td>
                                    <table class="table table-borderless table-sm table-valign-middle p-0">
                                        <tbody>
                                            <tr class="p-0 m-0">
                                                <th class="text-nowrap p-0 m-0" style="width: 20%">{{ __('datetime') }}</th>
                                                <td>{{ $track->track_date . ' ' . $track->track_time }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap p-0 m-0">{{ __('title') }}</th>
                                                <td>{{ $track->track_title }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap p-0 m-0">{{ __('place') }}</th>
                                                <td>{{ $track->track_place }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap p-0 m-0">{{ __('userID') }}</th>
                                                <td>{{ $track->userId }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap p-0 m-0">{{ __('userName') }}</th>
                                                <td>{{ $track->name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap p-0 m-0">{{ __('centerName') }}</th>
                                                <td>{{ $track->centerName }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap p-0 m-0">{{ __('status') }}</th>
                                                <td>{{ $track->track_status_name }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                "info": true,
                "paging": true,
                //"buttons": ["copy", "excel", "pdf", "print"],
                "language": {
                    "sProcessing": "データ取得中",
                    "sLengthMenu": "1 ページあたり MENU 件のレコードを表示",
                    "sZeroRecords": "結果が見つかりません",
                    "sEmptyTable": "結果が見つかりません",
                    "sInfo": "合計 _TOTAL_ レコードの _START_ から _END_ までを表示しています",
                    "sInfoEmpty": "合計 0 レコードの 0 から 0 を表示しています",
                    "sInfoFiltered": "(合計 MAX レコードからフィルタリング)",
                    "sInfoPostFix": "",
                    "sSearch": "検索",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "読み込んでいます...",
                    "oPaginate": {
                        "sFirst": "最初",
                        "sLast": "最後",
                        "sNext": "次",
                        "sPrevious": "前"
                    },
                    "oAria": {
                        "sSortAscending": ": 列を昇順で並べ替えるには有効にします",
                        "sSortDescending": ": 列を降順でソートするには、アクティブにします"
                    }
                }
            }).buttons().container().appendTo('#store-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
