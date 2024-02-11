<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/template/backend/dist/js/adminlte.js') }}"></script>
<!-- Sweetalert -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    function showLoading() {
        Swal.fire({
            title: 'Please wait...',
            html: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden"></span></div><p class="text-danger">Your request is still processed, please don`t refresh this page!</p>',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            },
        });
    }

    $(document).on("submit", ".delete-data", function(e) {
        e.preventDefault();
        const url = $(this).attr("href");
        Swal.fire({
            title: 'Are you sure?',
            text: "Data will be deleted permanently!",
            icon: 'warning',
            timer: 3000,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading();
                e.currentTarget.submit();
            }
        })
    });
</script>
@include('sweetalert::alert')
