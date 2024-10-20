@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <div class="btn-group">
                            <a href="{{ route('users.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                {{ __('Add') }}
                            </a>
                            <button href="#" class="btn btn-dark" onclick="reload_table()">
                                <i class="fa fa-refresh"></i>
                                Refresh
                            </button>
                        </div>
                    </h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table my-3 table-striped table-bordered" width="100%">
                            <thead>
                                <th style="width: 5%">No.</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th style="width: 10%">No. HP</th>
                                <th style="width: 15%">Email</th>
                                <th style="width: 15%">Role</th>
                                <th style="width: 5%">Aksi</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@section('script_addon_footer')
    @include('backend.master.user.include.script')
@endsection
