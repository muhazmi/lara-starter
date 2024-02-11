@extends('layouts.app')

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <form action="{{ route('navigations.update', $navigations->id) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- @php
    dd($navigations->url);
@endphp --}}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">Menu Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ old('name', $navigations->name) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">URL</label>
                            <input type="text" class="form-control" name="url" id="url"
                                value="{{ old('url', $navigations->url) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">Icon</label>
                            <input type="text" class="form-control" name="icon" id="icon"
                                value="{{ old('icon', $navigations->icon) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">Sort</label>
                            <input type="number" class="form-control" name="sort" id="sort"
                                value="{{ old('sort', $navigations->sort) }}">
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-3"><label for="name">SubMenu Name</label></div>
                    <div class="col-md-3"><label for="name">URL</label></div>
                    <div class="col-md-3"><label for="name">Icon</label></div>
                    <div class="col-md-3"><label for="name">Sort</label></div>
                </div>

                <div class="form-group" id="dynamicFields">
                    <!-- Display existing submenus -->
                    @foreach ($navigations->submenus as $submenu)
                        <div class="row mb-3" id="row{{ $loop->index }}">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="submenu_name[]" placeholder="SubMenu Name"
                                    value="{{ old('submenu_name.' . $loop->index, $submenu->name) }}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="submenu_url[]" placeholder="URL"
                                    value="{{ old('submenu_url.' . $loop->index, $submenu->url) }}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="submenu_icon[]" placeholder="Icon"
                                    value="{{ old('submenu_icon.' . $loop->index, $submenu->icon) }}">
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="form-control" name="submenu_sort[]" placeholder="Sort"
                                    value="{{ old('submenu_sort.' . $loop->index, $submenu->sort) }}">
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger" onclick="removeRow({{ $loop->index }})">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach

                </div>

                <button type="button" class="btn btn-success" id="addRow"><i class="fa fa-plus"></i> Add
                    SubMenu</button>
            </div>
            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                <button type="reset" name="reset" class="btn btn-danger"><i class="fa fa-sync"></i> Reset</button>
                <a href="{{ route('navigations.index') }}" name="reset" class="btn btn-dark"><i
                        class="fa fa-arrow-left"></i>
                    Back</a>
            </div>
            <!-- /.card-body -->
        </div>
    </form>
@endsection

@section('script_addon')
    <script>
        $(document).ready(function() {
            // Counter for dynamic fields
            var counter = 0;

            // Function to add a new row
            $("#addRow").on("click", function() {
                counter++;
                var newRow = `<div class="row mb-3" id="row${counter}">
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="submenu_name[]" placeholder="SubMenu Name">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="submenu_url[]" placeholder="URL">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="submenu_icon[]" placeholder="Icon">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control" name="submenu_sort[]" placeholder="Sort">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger" onclick="removeRow(${counter})">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>`;

                $("#dynamicFields").append(newRow);
            });

            // Function to remove a row
            window.removeRow = function(rowId) {
                $("#row" + rowId).remove();
            };
        });
    </script>
@endsection
