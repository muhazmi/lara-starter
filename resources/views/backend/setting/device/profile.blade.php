@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Profil Perangkat: {{ $device->name }}</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Nama:</strong> 
                            {{ $response['data']['name'] ?? 'Tidak Diketahui' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Phone Number (Device):</strong> 
                            {{ $response['data']['device'] ?? 'Tidak Diketahui' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Device Status:</strong> 
                            {{ $response['data']['device_status'] ?? 'Tidak Diketahui' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Expired:</strong> 
                            {{ $response['data']['expired'] ?? 'Tidak Diketahui' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Package:</strong> 
                            {{ $response['data']['package'] ?? 'Tidak Diketahui' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Quota:</strong> 
                            {{ $response['data']['quota'] ?? 'Tidak Diketahui' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Total Messages:</strong> 
                            {{ $response['data']['messages'] ?? 'Tidak Diketahui' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Status:</strong> 
                            {{ $response['data']['status'] ?? 'Tidak Diketahui' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Token:</strong> 
                            {{ $device->token }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
