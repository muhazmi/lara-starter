@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ ucfirst($role->name) }} Role
            </h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <h3>Assigned permissions</h3>

            <table class="table table-striped">
                <thead>
                    <th scope="col" width="20%">Name</th>
                    <th scope="col" width="1%">Guard</th>
                </thead>

                @foreach ($rolePermissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->guard_name }}</td>
                    </tr>
                @endforeach
            </table>

            <div class="mt-4">
                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">Edit</a>
                <a href="{{ route('roles.index') }}" class="btn btn-default">Back</a>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
