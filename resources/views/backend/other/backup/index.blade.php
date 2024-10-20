<!-- resources/views/backend/other/backup/index.blade.php -->

@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Tombol untuk membuat backup baru -->
            <form id="backup-form" action="{{ route('backup.run') }}" method="POST">
                @csrf
                <button type="submit" class="mb-3 btn btn-primary">Backup Database</button>
            </form>

            <!-- Tombol untuk menghapus semua backup -->
            <form action="{{ route('backup.deleteAll') }}" method="POST"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua backup?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="mb-3 btn btn-danger">Hapus Semua Backup</button>
            </form>

            <!-- Tabel daftar file backup -->
            @if (count($backups) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama File</th>
                            <th>Ukuran</th>
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($backups as $backup)
                            <tr>
                                <td>{{ $backup->filename }}</td>
                                <td>{{ number_format($backup->size / 1024, 2) }} KB</td>
                                <td>{{ $backup->created_at }}</td>
                                <td>
                                    <!-- Tombol untuk mendownload file backup -->
                                    <a href="{{ route('backup.download', $backup->filename) }}" class="btn btn-info">Download</a>

                                    <!-- Tombol untuk menghapus file backup -->
                                    <form action="{{ route('backup.delete', $backup->filename) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus backup ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Tidak ada file backup.</p>
            @endif
        </div>
    </div>
@endsection

@section('script_addon_footer')
    @include('backend.other.backup.include.script')
@endsection
