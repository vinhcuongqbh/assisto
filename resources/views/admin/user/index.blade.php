@extends('layouts.master')

@section('title', 'User Management')

@section('heading')
    {{ __('userManagement') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a href="{{ route('user.create') }}"><button type="button"
                                        class="btn bg-olive text-white w-100 text-nowrap"><span>{{ __('newUser') }}</span></button></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('user.search') }}" method="post" id="store-search">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-xl-2 my-2">
                                    <input type="text" class="form-control" id="userID" name="userID"
                                        placeholder="{{ __('userID') }}">
                                </div>
                                <div class="col-12 col-xl-2 my-2">
                                    <input type="text" class="form-control" id="userName" name="userName"
                                        placeholder="{{ __('userName') }}">
                                </div>
                                <div class="col-12 col-xl-2 my-2">
                                    <input type="text" class="form-control" id="centerID" name="centerID"
                                        placeholder="{{ __('centerID') }}">
                                </div>
                                <div class="col-12 col-xl-2 my-2">
                                    <input type="text" class="form-control" id="centerName" name="centerName"
                                        placeholder="{{ __('centerName') }}">
                                </div>
                                <div class="col-12 col-xl-2 my-2">
                                    <button type="submit"
                                        class="btn bg-olive text-white w-100 text-nowrap">{{ __('search') }}</button>
                                </div>
                            </div>
                        </form>
                        <table id="user-table" class="table table-bordered">
                            <thead style="text-align: center">
                                <tr>
                                    <th>{{ __('userID') }}</th>
                                    <th>{{ __('userInformation') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td style="text-align: center">
                                            <a href="{{ route('user.show', $user->userId) }}">{{ $user->userId }}</a>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p><strong>{{ $user->name }}</strong></p>
                                                </div>
                                            </div>
                                            <table class="table table-borderless w-100">
                                                <tbody>
                                                    <tr>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td class="text-sm p-0 text-nowrap"><strong>{{ __('centerName') }}:</strong></td>
                                                        <td class="text-sm p-0">{{ $user->centerName }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-sm p-0 text-nowrap"><strong>{{ __('userRole') }}:</strong></td>
                                                        <td class="text-sm p-0">{{ $user->roleName }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="row p-0">
                                                <div class="col-md-6">
                                                    <a href="{{ route('user.edit', $user->userId) }}" class="btn bg-warning text-white w-100 text-nowrap m-1">{{ __('edit') }}</a>
                                                </div>
                                               <div class="col-md-6">
                                                    @if ($user->isDeleted == 0)
                                                        <a class="btn bg-olive text-white w-100 text-nowrap m-1"
                                                            href="{{ route('user.delete', $user->userId) }}"
                                                            onclick="return confirm('{{ __('deleteUser') }}')">
                                                            {{ __('enable') }}
                                                        </a>
                                                    @else
                                                        <a class="btn btn-danger text-white w-100 text-nowrap m-1"
                                                            href="{{ route('user.restore', $user->userId) }}"
                                                            onclick="return confirm('{{ __('restoreUser') }}')">
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
            $("#user-table").DataTable({
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
                    "sInfoFiltered": "(合計 _MAX_ レコードからフィルタリング)",
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
            }).buttons().container().appendTo('#user-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
