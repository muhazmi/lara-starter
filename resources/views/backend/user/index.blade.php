@extends('layouts.app')

@section('content')
    @if ($message = Session::get('message'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    Add Data
                </a>
                <a href="#" class="btn btn-dark" onclick="reload_table()"><i class="fa fa-refresh"></i> Refresh</a>
            </h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@section('script_addon')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('users.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'roles',
                        name: 'roles'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                ],
                aaSorting: [
                    [0, 'desc']
                ],
                oLanguage: {
                    "sEmptyTable": "Belum ada data",
                    "sProcessing": "Sedang memproses...",
                    "sLengthMenu": "Tampilkan _MENU_ data",
                    "sZeroRecords": "Tidak ditemukan data yang sesuai",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "sInfoFiltered": "(disaring dari total _MAX_ data)",
                    "sSearch": "Cari:",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "Sebelumnya",
                        "sNext": "Selanjutnya",
                        "sLast": "Terakhir"
                    }
                },
                lengthMenu: [
                    [10, 25, 50, 100, 500, 1000, -1],
                    [10, 25, 50, 100, 500, 1000, "Semua"]
                ],
            });
        });

        function reload_table() {
            table.ajax.reload(null, false); //reload datatable ajax
        }
    </script>
@endsection
