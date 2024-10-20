<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery3.7.1.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/template/backend/dist/js/adminlte.min.js') }}"></script>
<!-- BS Custom File Input -->
<script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
{{-- Bootstrap Switch --}}
<script src="{{ asset('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- Moment -->
<script type="text/javascript" src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<!-- Sweetalert -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
@include('sweetalert::alert')

<script>
    $(function() {
        bsCustomFileInput.init();
    });

    $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

    // delete data
    $(document).on("submit", ".delete-data", function(e) {
        e.preventDefault();
        const url = $(this).attr("action");

        Swal.fire({
            title: "{{ __('Are you sure?') }}",
            text: "{{ __('Data will be deleted') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ __('Yes') }}",
            cancelButtonText: "{{ __('Cancel') }}",
            timer: 2000,
            timerProgressBar: true
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Loading...',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: url,
                    type: 'POST', // Change to POST
                    data: {
                        _method: 'DELETE', // This is the method spoofing
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        Swal.fire({
                            title: response.success,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            timer: 1000,
                            timerProgressBar: true
                        }).then(() => {
                            Swal.close();
                            $('#dataTable').DataTable().ajax.reload();
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    });
</script>
