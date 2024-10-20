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
                                        <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-warning">Edit</a>
                                        <button onclick="requestOtp({{ $device->id }})" class="btn btn-danger">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for OTP input -->
    <div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="otpModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="otpModalLabel">Masukkan Kode OTP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="otpForm" action="{{ route('devices.submitOTP', $device->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="otp">Kode OTP</label>
                            <input type="text" name="otp" id="otp" class="form-control" required>
                        </div>
                        <input type="hidden" name="device_id" id="device_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="submitOtpBtn">Submit OTP</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_addon_footer')
<script>
    // Handle delete button click
    function requestOtp(deviceId) {
        $.ajax({
            url: `/admin/setting/devices/${deviceId}/request-otp`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                if (response.status) {
                    // Show modal for OTP input
                    $('#device_id').val(deviceId);
                    $('#otpModal').modal('show');
                } else {
                    alert(response.error || 'Gagal meminta OTP');
                }
            },
            error: function (xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    }

    // Handle OTP form submission
    $('#submitOtpBtn').on('click', function (e) {
        e.preventDefault();
        const form = $('#otpForm');
        form.submit();
    });
</script>
@endsection
