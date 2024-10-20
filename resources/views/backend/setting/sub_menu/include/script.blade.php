<!-- datatables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/datatables.min.css') }}">
<script src="{{ asset('assets/plugins/datatables-bs4/datatables.min.js') }}"></script>
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
            ajax: '{{ route('sub_menus.index') }}',
            columns: [{
                    data: 'sort',
                    name: 'sort',
                    class: 'text-center'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'menu.name',
                    name: 'menu.name'
                },
                {
                    data: 'menu.url',
                    name: 'menu.url'
                },
                {
                    data: 'menu.icon',
                    name: 'menu.icon'
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

        // Ensure single event listener for create menu form submission
        $('#create-submenu-form').off('submit').on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Loading...',
                backdrop: true,
                didOpen: () => {
                    Swal.showLoading();
                },
                allowOutsideClick: () => !Swal.isLoading()
            });

            // Remove previous error messages and classes
            resetValidationErrors('#create-submenu-form');

            let formData = new FormData(this);
            let url = '{{ route('sub_menus.store') }}';

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: '{{ __('Success!') }}',
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            timer: 1000,
                            timerProgressBar: true
                        }).then(() => {
                            $('#createItemModal').modal('hide'); // Close the modal
                            $('#dataTable').DataTable().ajax.reload();
                            resetForm('#create-submenu-form',
                                '#create'); // Clear the form and errors
                        });
                    }
                },
                error: function(response) {
                    if (response.status === 422) {
                        Swal.close();

                        let errors = response.responseJSON.errors;
                        displayValidationErrors(errors, '#create');
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });

        // Ensure single event listener for edit menu form submission
        $('#edit-submenu-form').off('submit').on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Loading...',
                backdrop: true,
                didOpen: () => {
                    Swal.showLoading();
                },
                allowOutsideClick: () => !Swal.isLoading()
            });

            // Remove previous error messages and classes
            resetValidationErrors('#edit-submenu-form');

            let formData = new FormData(this);
            formData.append('_method', 'PUT'); // Ensure the method is set to PUT

            let url = '{{ route('sub_menus.update', ':id') }}';
            let id = $('#edit-id').val();
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.close(); // Close loading indicator
                    if (response.success) {
                        Swal.fire({
                            title: '{{ __('Success!') }}',
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            timer: 1000,
                            timerProgressBar: true
                        }).then(() => {
                            $('#editItemModal').modal('hide'); // Close the modal
                            $('#dataTable').DataTable().ajax.reload();
                            resetForm('#edit-submenu-form',
                                '#edit'); // Clear the form and errors
                        });
                    }
                },
                error: function(response) {
                    Swal.close(); // Close loading indicator
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        displayValidationErrors(errors, '#edit');
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });

        // Edit button click event
        $(document).on('click', '.edit', function() {
            const url = $(this).data('url');

            Swal.fire({
                title: 'Loading...',
                backdrop: true,
                didOpen: () => {
                    Swal.showLoading();
                },
                allowOutsideClick: () => !Swal.isLoading()
            });

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    Swal.close();

                    $('#edit-id').val(response.menu.id);
                    $('#edit-menu_id').val(response.menu.menu_id);
                    $('#edit-name').val(response.menu.name);
                    $('#edit-url').val(response.menu.url);
                    $('#edit-icon').val(response.menu.icon);
                    $('#edit-sort').val(response.menu.sort);

                    $('#editItemModal').modal('show');
                }
            });
        });

        $('#refresh').on('click', function() {
            $('#dataTable').DataTable().ajax.reload();
        });

        function resetValidationErrors(formId) {
            $(`${formId} .invalid-feedback`).hide(); // Sembunyikan semua pesan error
            $(`${formId} input, ${formId} textarea, ${formId} select`).removeClass(
                'is-invalid'); // Hapus kelas is-invalid
        }

        function displayValidationErrors(errors, prefix) {
            if (errors.menu_id) {
                $(`${prefix}-menu_id-error`).text(errors.menu_id[0]).show();
                $(`${prefix}-menu_id`).addClass('is-invalid');
            }
            if (errors.name) {
                $(`${prefix}-name-error`).text(errors.name[0]).show();
                $(`${prefix}-name`).addClass('is-invalid');
            }
            if (errors.url) {
                $(`${prefix}-url-error`).text(errors.url[0]).show();
                $(`${prefix}-url`).addClass('is-invalid');
            }
            if (errors.icon) {
                $(`${prefix}-icon-error`).text(errors.icon[0]).show();
                $(`${prefix}-icon`).addClass('is-invalid');
            }
            if (errors.sort) {
                $(`${prefix}-sort-error`).text(errors.sort[0]).show();
                $(`${prefix}-sort`).addClass('is-invalid');
            }
        }

        // Function to remove formatting before form submission
        function remove_formatting(selector) {
            $(selector).each(function() {
                let value = $(this).val();
                $(this).val(value.replace(/,/g, ''));
            });
        }

        function resetForm(formId, prefix) {
            $(formId)[0].reset(); // Reset form fields
            resetValidationErrors(formId); // Reset error messages
        }

        // Reset form fields and errors when create modal is closed
        $('#createItemModal').on('hidden.bs.modal', function() {
            resetForm('#create-submenu-form', '#create');
        });

        // Reset form fields and errors when edit modal is closed
        $('#editItemModal').on('hidden.bs.modal', function() {
            resetForm('#edit-submenu-form', '#edit');
        });
    });
</script>
