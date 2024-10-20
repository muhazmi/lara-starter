@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                            {{ __('Add') }}
                        </a>
                    </h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table my-3 table-striped table-bordered">
                            <thead>
                                <th style="text-align: center; width: 5%;">No.</th>
                                <th>Name</th>
                                <th>Permission</th>
                                <th style="text-align: center; width: 5%;">{{ __('Action') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($roles as $index => $roles)
                                    <tr>
                                        <td style="width: 50px; text-align:center">{{ $index + 1 }}</td>
                                        <td style="width: 250px">{{ $roles->name }}</td>
                                        <td>
                                            <h5>
                                                @foreach ($roles->permissions as $permission)
                                                    <span class="badge badge-primary"><i
                                                            class="{{ $permission->icon }}"></i>
                                                        {{ $permission->name }}</span>
                                                @endforeach
                                            </h5>
                                        </td>
                                        <td style="width: 100px; text-align:center">
                                            <form action="{{ route('roles.destroy', $roles->id) }}" method="POST"
                                                class="d-inline delete-data">
                                                <div class="btn-group">
                                                    <a href="{{ route('roles.edit', $roles->id) }}" class="btn btn-warning">
                                                        <i class="fa fa-pencil-alt"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" title='Delete'>
                                                        <i class="fa fa-trash-can"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
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
    <!-- datatables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/datatables.min.css') }}">
    <script src="{{ asset('assets/plugins/datatables-bs4/datatables.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                columnDefs: [{
                        targets: -1,
                        orderable: false
                    } // Menonaktifkan urutan untuk kolom terakhir
                ]
            });
        });
    </script>
@endsection
