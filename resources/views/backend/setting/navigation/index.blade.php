@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('navigations.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    {{ __('Add') }}
                </a>
            </h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered my-3">
                    <thead>
                        <th style="text-align:center; width: 10%;">{{ __('Order Number') }}</th>
                        <th style="text-align:center; width: 15%;">{{ __('Menu Name') }}</th>
                        <th>URL</th>
                        <th>Icon (Code)</th>
                        <th class="text-left">Icon</th>
                        <th>SubMenu</th>
                        <th style="text-align:center; width: 15%;">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($navigations as $mainMenu)
                            <tr>
                                <td style="width: 5%; text-align:center">{{ $mainMenu->sort }}</td>
                                <td>{{ $mainMenu->name }}</td>
                                <td>{{ $mainMenu->url }}</td>
                                <td style="width: 15%">{{ $mainMenu->icon }}</td>
                                <td style="width: 15%; text-align:center"><i class="{{ $mainMenu->icon }}"></i></td>
                                <td style="width: 30%">
                                    <h5>
                                        @foreach ($mainMenu->subMenus as $submenu)
                                            <span class="badge badge-primary"><i class="{{ $submenu->icon }}"></i>
                                                {{ $submenu->name }}</span>
                                        @endforeach
                                    </h5>
                                </td>
                                <td style="width: 100px; text-align:center">
                                    <form action="{{ route('navigations.destroy', $mainMenu->id) }}" method="POST"
                                        class="d-inline delete-data">
                                        <div class="btn-group">
                                            <a href="{{ route('navigations.edit', $mainMenu->id) }}"
                                                class="btn btn-warning">
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
@endsection

@section('script_addon_footer')
    <!-- datatables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/datatables.min.css') }}">
    <script src="{{ asset('assets/plugins/datatables-bs4/datatables.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                aaSorting: [
                    [0, 'asc']
                ],
                columnDefs: [{
                        targets: -1,
                        orderable: false
                    } // Menonaktifkan urutan untuk kolom terakhir
                ]
            });
        });
    </script>
@endsection
