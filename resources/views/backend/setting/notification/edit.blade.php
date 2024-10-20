@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('notifications.update', $apiKey->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $apiKey->title }}" required>
                        </div>

                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                value="{{ $apiKey->slug }}" required>
                        </div>

                        <div class="form-group">
                            <label for="documentation_homepage_url">Documentation URL</label>
                            <input type="url" name="documentation_homepage_url" id="documentation_homepage_url"
                                class="form-control" value="{{ $apiKey->documentation_homepage_url }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('notification.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@section('script_addon_footer')
@endsection
