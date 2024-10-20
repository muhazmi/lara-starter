@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <button href="#" class="btn btn-dark" id="refresh">
                            <i class="fa fa-refresh"></i>
                            Refresh
                        </button>
                    </div>
                    <div class="mt-3 mt-md-0 card-tools">
                        <div class="row" id="action">
                            <div class="mb-2 col-12 col-md-auto mb-md-0">
                                <select id="event-filter" class="form-control">
                                    <option value="">All Events</option>
                                    <option value="created">Created</option>
                                    <option value="updated">Updated</option>
                                    <option value="deleted">Deleted</option>
                                </select>
                            </div>
                            <div class="mb-2 col-12 col-md-auto mb-md-0">
                                <select id="logname-filter" class="form-control">
                                    <option value="">All Modules</option>
                                </select>

                            </div>
                            <div class="mb-2 col-12 col-md-auto mb-md-0">
                                <select id="initiator-filter" class="form-control">
                                    <option value="">All Initiators</option>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table my-3 table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th style="text-align:center; width:5%">No.</th>
                                    <th style="text-align:center; width:5%">ID</th>
                                    <th style="text-align:center; width:10%">Module</th>
                                    <th style="text-align:center; width:5%">Status</th>
                                    <th style="text-align:center; width:10%">Initiator</th>
                                    <th>{{ __('Changes') }}</th>
                                    <th style="text-align:center; width:15%">Created At</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_addon_footer')
    <!-- datatables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/datatables.min.css') }}">
    <script src="{{ asset('assets/plugins/datatables-bs4/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            let table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{{ route('logs.index') }}',
                    data: function(d) {
                        d.event = $('#event-filter').val();
                        d.log_name = $('#logname-filter').val();
                        d.initiator = $('#initiator-filter').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'dt-body-center'
                    },
                    {
                        data: 'record_id',
                        name: 'record_id',
                        className: 'dt-body-center'
                    },
                    {
                        data: 'log_name',
                        name: 'log_name',
                        className: 'dt-body-center'
                    },
                    {
                        data: 'event',
                        name: 'event',
                        className: 'dt-body-center'
                    },
                    {
                        data: 'causer_name',
                        name: 'causer_name',
                        className: 'dt-body-center'
                    },
                    {
                        data: 'changes',
                        name: 'changes',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        className: 'dt-body-center'
                    },
                ],
                drawCallback: function(settings) {
                    let logNames = [];
                    let initiators = [];
                    let currentLogName = $('#logname-filter')
                        .val(); // Menyimpan nilai yang dipilih saat ini
                    let currentInitiator = $('#initiator-filter')
                        .val(); // Menyimpan nilai yang dipilih saat ini

                    // Mengumpulkan log_name dan initiator dari data yang ditampilkan saat ini di DataTables
                    table.rows({
                        page: 'current'
                    }).every(function(rowIdx, tableLoop, rowLoop) {
                        let data = this.data();
                        if (!logNames.includes(data.log_name)) {
                            logNames.push(data.log_name);
                        }
                        if (!initiators.includes(data.causer_name)) {
                            initiators.push(data.causer_name);
                        }
                    });

                    // Hapus opsi yang ada di select box log_name dan tambahkan opsi baru berdasarkan data log_name yang unik
                    $.each(logNames, function(index, logName) {
                        if ($('#logname-filter option[value="' + logName + '"]').length === 0) {
                            $('#logname-filter').append('<option value="' + logName + '">' +
                                logName + '</option>');
                        }
                    });

                    // Hapus opsi yang ada di select box initiator dan tambahkan opsi baru berdasarkan data initiator yang unik
                    $.each(initiators, function(index, initiator) {
                        if ($('#initiator-filter option[value="' + initiator + '"]').length ===
                            0) {
                            $('#initiator-filter').append('<option value="' + initiator + '">' +
                                initiator + '</option>');
                        }
                    });

                    // Kembalikan ke nilai yang dipilih sebelumnya
                    $('#logname-filter').val(currentLogName);
                    $('#initiator-filter').val(currentInitiator);
                },
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
                    [10, 25, 50, 100, 500, 1000],
                    [10, 25, 50, 100, 500, 1000]
                ],
            });

            // Event handler untuk perubahan pada select box event
            $('#event-filter').on('change', function() {
                table.ajax.reload(); // Reload DataTables dengan filter baru
            });

            // Event handler untuk perubahan pada select box log_name
            $('#logname-filter').on('change', function() {
                table.ajax.reload(); // Reload DataTables dengan filter baru
            });

            // Event handler untuk perubahan pada select box initiator
            $('#initiator-filter').on('change', function() {
                table.ajax.reload(); // Reload DataTables dengan filter baru
            });

            // Event handler untuk tombol refresh
            $('#refresh').on('click', function() {
                $('#event-filter').val('');
                $('#logname-filter').val('');
                $('#initiator-filter').val('');
                table.ajax.reload();
            });
        });
    </script>
@endsection
