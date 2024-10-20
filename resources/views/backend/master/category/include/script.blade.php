<!-- datatables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/datatables.min.css') }}">
<script src="{{ asset('assets/plugins/datatables-bs4/datatables.min.js') }}"></script>
<!-- select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<script type="text/javascript" src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- daterangepicker -->
<link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
<script type="text/javascript" src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

<script>
    $(document).ready(function() {
        // dataTable
        table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ route('categories.index') }}',
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
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'category_type.name',
                    name: 'category_type.name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
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

        table.clear().draw();

        // Initialize select2 for modals
        function initializeSelect2ForModal(modalId, selectId) {
            $(modalId).on('shown.bs.modal', function() {
                $(selectId).select2({
                    theme: 'bootstrap4',
                    dropdownParent: $(modalId)
                });
            });
        }

        // Call the function for create modal
        initializeSelect2ForModal('#createItemModal', '#category_type_id');

        // Call the function for edit modal
        initializeSelect2ForModal('#editItemModal', '#edit-category_type_id');

        // Create form submission
        $('#create-category-form').on('submit', function(e) {
            e.preventDefault();

            // Clear existing error messages and remove is-invalid class
            $('#create-name-error').hide();
            $('[name="name"]').removeClass('is-invalid');
            $('#create-category_type_id-error').hide();
            $('[name="category_type_id"]').removeClass('is-invalid');

            let formData = $(this).serialize();
            let url = '{{ route('categories.store') }}';

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: response.success,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            timer: 1000,
                            timerProgressBar: true
                        }).then(() => {
                            $('#createItemModal').modal('hide');
                            table.ajax.reload(null, false);
                        });
                    }
                },
                error: function(response) {
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        if (errors.name) {
                            $('#create-name-error').text(errors.name[0]).show();
                            $('[name="name"]').addClass('is-invalid');
                        }
                        if (errors.category_type_id) {
                            $('#create-category_type_id-error').text(errors
                                .category_type_id[0]).show();
                            $('[name="category_type_id"]').addClass('is-invalid');
                        }
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while saving the data.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });

        // Show edit modal with pre-filled data
        // Event delegation for edit button click
        $('#dataTable').on('click', '.edit-btn', function() {
            let id = $(this).data('id');
            let url = '{{ route('categories.show', ':id') }}'.replace(':id', id); // Adjust this route

            // Fetch category details using AJAX
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Isi form modal dengan data yang diterima
                    $('#edit-id').val(response.id);
                    $('#edit-name').val(response.name);
                    $('#edit-category_type_id').val(response.category_type_id).trigger(
                        'change');

                    // Tampilkan modal edit
                    $('#editItemModal').modal('show');
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to fetch category details.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });

        // Update vehicle form submission
        $('#edit-category-form').on('submit', function(e) {
            e.preventDefault();

            // Clear existing error messages and remove is-invalid class
            $('#edit-name-error').hide();
            $('#edit-name').removeClass('is-invalid');
            $('#edit-category_type_id-error').hide();
            $('#edit-category_type_id').removeClass('is-invalid');

            let formData = $(this).serialize();
            let id = $('#edit-id').val();
            let url = '{{ route('categories.update', ':id') }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'PUT',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: response.success,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            timer: 1000,
                            timerProgressBar: true
                        }).then(() => {
                            $('#editItemModal').modal('hide');
                            table.ajax.reload(null, false);
                        });
                    }
                },
                error: function(response) {
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        if (errors.name) {
                            $('#edit-name-error').text(errors.name[0]).show();
                            $('#edit-name').addClass('is-invalid');
                        }
                        if (errors.category_type_id) {
                            $('#edit-category_type_id-error').text(errors.category_type_id[
                                0]).show();
                            $('#edit-category_type_id').addClass('is-invalid');
                        }
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while updating the data.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });
    });
</script>
