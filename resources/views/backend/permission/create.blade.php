@extends('layouts.app')

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="guard_name">Guard Name</label>
                    <input type="text" class="form-control" name="guard_name" id="guard_name" value="{{ old('guard_name') }}"
                        required>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                <button type="reset" name="reset" class="btn btn-danger"><i class="fa fa-sync"></i> Reset</button>
                <a href="{{ route('permissions.index') }}" name="reset" class="btn btn-dark"><i class="fa fa-arrow-left"></i>
                    Back</a>
            </div>
            <!-- /.card-body -->
        </div>
    </form>
@endsection
