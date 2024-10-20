<!-- daterangepicker -->
<link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
<script type="text/javascript" src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<script type="text/javascript" src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- datatables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/datatables.min.css') }}">
<script src="{{ asset('assets/plugins/datatables-bs4/datatables.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('articles.index') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-center'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'tags',
                    name: 'tags'
                },
                {
                    data: 'is_published',
                    name: 'is_published',
                    className: 'text-center'
                },
                {
                    data: 'published_at',
                    name: 'published_at',
                    className: 'text-center'
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
