@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $page_title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('notifications.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Tambah Notifikasi (API Key)
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Documentation URL</th>
                                <th>Jumlah Perangkat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apiKeys as $key)
                                <tr>
                                    <td>{{ $key->title }}</td>
                                    <td>{{ $key->slug }}</td>
                                    <td><a href="{{ $key->documentation_homepage_url }}" target="_blank">Lihat Dokumentasi</a></td>
                                    <td>{{ $key->devices->count() }}</td>
                                    <td>
                                        <a href="{{ route('notifications.show', $key->id) }}" class="btn btn-info">Lihat Perangkat</a>
                                        <a href="{{ route('notifications.edit', $key->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('notifications.destroy', $key->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
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
