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
                                    <th class="text-nowrap">{{ __('enable') }}/{{ __('disable') }}</th>
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
                                                <button type="button" class="btn bg-warning text-white w-100 text-nowrap">{{ __('edit') }}</button>
                                            </a>
                                        </td>
                                        <td>
                                            @if ($center->isDeleted == 0)
                                                <a href="{{ route('center.delete', $center->centerId) }}"
                                                    onclick="return confirm('{{ __('deleteCenter') }}')">
                                                    <button type="button" class="btn bg-olive text-white w-100 text-nowrap">{{ __('enable') }}</button>
                                                </a>
                                            @else
                                                <a class="btn bg-danger text-white w-100 text-nowrap" href="{{ route('center.restore', $center->centerId) }}"
                                                    onclick="return confirm('{{ __('restoreCenter') }}')">
                                                    {{ __('disable') }}
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
                "language": {
                    "sProcessing": "データ取得中",
                    "sLengthMenu": "1 ページあたり MENU 件のレコードを表示",
                    "sZeroRecords": "結果が見つかりません",
                    "sEmptyTable": "結果が見つかりません",
                    "sInfo": "合計 TOTAL レコードの START から END までを表示しています",
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
            }).buttons().container().appendTo('#center-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
