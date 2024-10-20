@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $page_title }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('devices.update', ['notification' => $device->api_key_id, 'device' => $device->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nama Perangkat</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $device->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="device">Nomor Telepon</label>
                            <input type="text" class="form-control" id="device" name="device" value="{{ $device->device }}" required>
                        </div>

                        <button type="submit" class="btn btn-success">Perbarui</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
