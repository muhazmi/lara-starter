@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $page_title }}</h3>
                    <a href="{{ route('devices.create', ['notification' => $apiKey->id]) }}" class="btn btn-primary">Tambah Perangkat</a>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Perangkat</th>
                                <th>Nomor Telepon</th>
                                <th>Token</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($devices as $device)
                                <tr>
                                    <td>{{ $device->name }}</td>
                                    <td>{{ $device->phone_number }}</td>
                                    <td>{{ $device->token }}</td>
                                    <td>
                                        <a href="{{ route('devices.checkProfile', $device->id) }}" class="btn btn-info">Cek Profil</a>
                                        <a href="{{ route('devices.edit', ['notification' => $apiKey->id, 'device' => $device->id]) }}" class="btn btn-warning">Edit</a>
                                        <button onclick="confirmDelete({{ $apiKey->id }}, {{ $device->id }})" class="btn btn-danger">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_addon_footer')
<script>
    function confirmDelete(notificationId, deviceId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan menghapus perangkat ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Mengirimkan request OTP untuk penghapusan perangkat
                $.post(`/admin/setting/notifications/${notificationId}/devices/${deviceId}/request-otp`, {
                    _token: '{{ csrf_token() }}'
                }).done(function(response) {
                    Swal.fire({
                        title: 'Masukkan Kode OTP',
                        input: 'text',
                        inputPlaceholder: 'Masukkan kode OTP yang dikirim ke perangkat',
                        showCancelButton: true,
                        confirmButtonText: 'Submit OTP',
                        cancelButtonText: 'Batal'
                    }).then((otpResult) => {
                        if (otpResult.isConfirmed) {
                            const otpCode = otpResult.value;

                            // Mengirim OTP untuk melakukan penghapusan perangkat
                            $.post(`/admin/setting/notifications/${notificationId}/devices/${deviceId}/submit-otp`, {
                                _token: '{{ csrf_token() }}',
                                otp: otpCode
                            }).done(function(response) {
                                Swal.fire('Dihapus!', 'Perangkat berhasil dihapus.', 'success');
                                location.reload(); // Refresh halaman setelah penghapusan berhasil
                            }).fail(function(xhr) {
                                const errorResponse = xhr.responseJSON.error || 'Kesalahan tidak diketahui';
                                Swal.fire('Gagal!', errorResponse, 'error');
                            });
                        }
                    });
                }).fail(function(xhr) {
                    const errorResponse = xhr.responseJSON.error || 'Kesalahan tidak diketahui';
                    Swal.fire('Gagal!', errorResponse, 'error');
                });
            }
        });
    }
</script>
@endsection