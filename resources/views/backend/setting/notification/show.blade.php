@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">
                        <strong>Documentation:</strong> <a href="{{ $apiKey->documentation_homepage_url }}"
                            target="_blank">{{ $apiKey->documentation_homepage_url }}</a><br>
                        <strong>Device Token:</strong> {{ $apiKey->device_token ?? 'N/A' }}<br>
                        <strong>Account Token:</strong> {{ $apiKey->account_token ?? 'N/A' }}<br>
                        <strong>API Key:</strong> {{ $apiKey->api_key ?? 'N/A' }}
                    </p>

                    <a href="{{ route('devices.index', $apiKey->id) }}" class="btn btn-warning">Lihat Perangkat</a>
                    <a href="{{ route('notifications.edit', $apiKey->id) }}" class="btn btn-primary">Edit API Key</a>
                    <form action="{{ route('notifications.destroy', $apiKey->id) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Yakin ingin menghapus API Key ini?')">Hapus</button>
                    </form>

                    <h2 class="mt-4">Daftar Perangkat Terkait</h2>

                    @if ($devices->isEmpty())
                        <div class="alert alert-info">Tidak ada perangkat yang terhubung dengan API Key ini.</div>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Perangkat</th>
                                    <th>Nomor Telepon</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($devices as $device)
                                    <tr>
                                        <td>{{ $device->device_name }}</td>
                                        <td>{{ $device->phone_number }}</td>
                                        <td>{{ $device->is_active ? 'Aktif' : 'Non-Aktif' }}</td>
                                        <td>
                                            <a href="{{ route('devices.edit', ['notification' => $apiKey->id, 'device' => $device->id]) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form
                                                action="{{ route('devices.destroy', ['notification' => $apiKey->id, 'device' => $device->id]) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus perangkat ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    <a href="{{ route('notifications.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@section('script_addon_footer')
@endsection
