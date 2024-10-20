<!-- datatables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/datatables.min.css') }}">
<script src="{{ asset('assets/plugins/datatables-bs4/datatables.min.js') }}"></script>

<script>
    document.getElementById('backup-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah form submit biasa

        Swal.fire({
            title: 'Sedang Membuat Backup...',
            text: 'Proses backup database sedang berlangsung. Harap tunggu.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading(); // Tampilkan loading
            }
        });

        fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    _token: '{{ csrf_token() }}'
                })
            })
            .then(response => response.json())
            .then(data => {
                Swal.close(); // Tutup animasi loading setelah backup selesai
                if (data.success) {
                    Swal.fire({
                        title: 'Backup Berhasil!',
                        text: 'Database berhasil di-backup.',
                        icon: 'success'
                    }).then(() => {
                        location.reload(); // Reload halaman untuk menampilkan file backup terbaru
                    });
                } else {
                    Swal.fire({
                        title: 'Terjadi Kesalahan',
                        text: data.message || 'Backup database gagal.',
                        icon: 'error'
                    });
                }
            })
            .catch(error => {
                Swal.close(); // Tutup animasi loading jika ada error
                console.error(error); // Log error untuk debugging
                Swal.fire({
                    title: 'Terjadi Kesalahan',
                    text: 'Backup database gagal. Silakan coba lagi.',
                    icon: 'error'
                });
            });

    });
</script>