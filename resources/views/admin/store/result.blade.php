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
                                <div class="col-12 col-sm-2 my-2">
                                    <input type="text" class="form-control" id="storeID" name="storeID"
                                        placeholder="{{ __('storeID') }}">
                                </div>
                                <div class="col-12 col-sm-2 my-2">
                                    <input type="text" class="form-control" id="storeName" name="storeName"
                                        placeholder="{{ __('storeName') }}">
                                </div>
                                <div class="col-12 col-sm-2 my-2">
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="{{ __('address') }}">
                                </div>
                                <div class="col-12 col-sm-2 my-2">
                                    <input type="text" class="form-control" id="telephone" name="telephone"
                                        placeholder="{{ __('telephone') }}">
                                </div>
                                <div class="col-12 col-sm-2 my-2">
                                    <input type="text" class="form-control" id="centerName" name="centerName"
                                        placeholder="{{ __('centerName') }}">
                                </div>
                                <div class="col-12 col-sm-2 my-2">
                                    <button type="submit"
                                        class="btn bg-olive text-white w-100">{{ __('search') }}</button>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <table id="store-table" class="table table-bordered bg-white">
                    <thead style="text-align: center">
                        <tr>
                            <th class="text-nowrap">{{ __('storeID') }}</th>
                            <th class="text-nowrap">{{ __('store') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stores as $store)
                            <tr>
                                <td class="text-center text-bold">
                                    <a href="{{ route('store.show', $store->storeId) }}">{{ $store->storeId }}</a>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><strong>{{ $store->storeName }}</strong></p>
                                        </div>
                                    </div>
                                    <table class="table table-borderless w-100">
                                        <tbody>
                                            <tr>
                                                <td class="text-sm p-0"><strong>{{ __('address') }}:</strong></td>
                                                <td class="text-sm p-0">{{ $store->storeAddr }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm p-0"><strong>{{ __('telephone') }}:</strong></td>
                                                <td class="text-sm p-0">{{ $store->storeTel }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm p-0"><strong>{{ __('centerName') }}:</strong></td>
                                                <td class="text-sm p-0">{{ $store->centerName }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row p-0">
                                        <div class="col-md-6 p-1">
                                            <a href="{{ route('store.edit', $store->storeId) }}">
                                                <button type="button"
                                                    class="btn bg-warning text-white w-100 text-nowrap">{{ __('edit') }}</button>
                                            </a>
                                        </div>
                                        <div class="col-md-6 p-1">
                                            @if ($store->isDeleted == 0)
                                                <a class="btn bg-olive text-white w-100 text-nowrap"
                                                    href="{{ route('store.delete', $store->storeId) }}"
                                                    onclick="return confirm('{{ __('deleteStore') }}')">
                                                    {{ __('enable') }}
                                                </a>
                                            @else
                                                <a class="btn bg-danger text-white w-100 text-nowrap"
                                                    href="{{ route('store.restore', $store->storeId) }}"
                                                    onclick="return confirm('{{ __('restoreStore') }}')">
                                                    {{ __('disable') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
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
