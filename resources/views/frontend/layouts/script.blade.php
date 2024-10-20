<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery3.7.1.min.js') }}"></script>
<!-- Moment -->
<script type="text/javascript" src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<!-- Sweetalert -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const successMessage = "{{ session('success') }}";
        const errorMessage = "{{ session('error') }}";

        if (successMessage) {
            Swal.fire({
                title: '{{ __('Success!') }}',
                text: successMessage,
                icon: 'success',
                timer: 3000,
                timerProgressBar: true,
            });
        }

        if (errorMessage) {
            Swal.fire({
                title: 'Oops...',
                text: errorMessage,
                icon: 'error',
                timer: 3000,
                timerProgressBar: true,
            });
        }
    });

    function showLoading() {
        Swal.fire({
            title: 'Loading...',
            text: 'Please wait.',
            backdrop: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading(); // This activates SweetAlert's native loading animation
            }
        });
    }
</script>

@yield('script_addon_footer')
