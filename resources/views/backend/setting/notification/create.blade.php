@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $page_title }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('notifications.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="documentation_homepage_url">Documentation URL</label>
                            <input type="url" class="form-control" id="documentation_homepage_url" name="documentation_homepage_url" value="{{ old('documentation_homepage_url') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="device_token">Device Token</label>
                            <input type="text" class="form-control" id="device_token" name="device_token" value="{{ old('device_token') }}">
                        </div>

                        <div class="form-group">
                            <label for="account_token">Account Token</label>
                            <input type="text" class="form-control" id="account_token" name="account_token" value="{{ old('account_token') }}">
                        </div>

                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
