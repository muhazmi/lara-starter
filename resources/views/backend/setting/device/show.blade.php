@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table my-3 table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>Nama Perangkat</th>
                                    <th>Nomor Telepon</th>
                                    <th>Status Aktif</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($devices as $device)
                                    <tr>
                                        <td>{{ $device->device_name }}</td>
                                        <td>{{ $device->phone_number }}</td>
                                        <td>{{ $device->is_active ? 'Aktif' : 'Non-Aktif' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@section('script_addon_footer')
    
@endsection
