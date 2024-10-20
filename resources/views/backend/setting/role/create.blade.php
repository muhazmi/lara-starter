@extends('backend.layouts.app')

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <div class="row">
        <div class="col-lg">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                                required>
                        </div>
        
                        <label for="permissions" class="form-label">{{ __('Permissions') }}</label>
                        <div class="form-group">
                            <input type="checkbox" name="all_modules" id="all_modules">
                            <label for="all_modules">{{ __('Select All Modules') }}</label>
                        </div>
        
                        <div class="row">
                            @foreach ($permissions as $module => $modulePermissions)
                                <div class="col-lg-6">
                                    <div class="mb-3 card">
                                        <div class="card-header">
                                            <h5>{{ ucfirst($module) }}</h5>
                                            <input type="checkbox" name="all_permission_{{ $module }}"
                                                id="all_permission_{{ $module }}">
                                            <label for="all_permission_{{ $module }}">{{ __('Select All') }}</label>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" width="1%">{{ __('Select') }}</th>
                                                            <th scope="col" width="20%">{{ __('Name') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($modulePermissions as $permission)
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox"
                                                                        name="permission[{{ $permission->name }}]"
                                                                        value="{{ $permission->name }}"
                                                                        class="permission_{{ $module }}">
                                                                </td>
                                                                <td>{{ $permission->name }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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

@section('script_addon_footer')
    <script type="text/javascript">
        $(document).ready(function() {
            // Mengontrol semua module
            $('#all_modules').on('click', function() {
                var isChecked = $(this).is(':checked');
                $('[name^="all_permission_"]').each(function() {
                    $(this).prop('checked', isChecked).trigger('change');
                });
            });

            @foreach ($permissions as $module => $modulePermissions)
                // Mengontrol permissions di dalam satu module
                $('#all_permission_{{ $module }}').on('change', function() {
                    var isChecked = $(this).is(':checked');
                    $('.permission_{{ $module }}').prop('checked', isChecked);
                });
            @endforeach
        });
    </script>
@endsection
