@extends('backend.layouts.app')

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <div class="row">
        <div class="col-lg">
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="guard_name">{{ __('Guard') }}</label>
                            <input type="text" class="form-control" name="guard_name" id="guard_name" value="{{ old('guard_name') }}"
                                required>
                        </div>
                    </div>
        
                    <div class="card-footer">
                        <x-form-footer-button></x-form-footer-button>
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>
        </div>
    </div>
@endsection
