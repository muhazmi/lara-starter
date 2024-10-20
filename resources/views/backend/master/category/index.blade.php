@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <div class="btn-group">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createItemModal">
                        <i class="fa fa-plus"></i>
                        {{ __('Add') }}
                    </button>
                    <button href="#" class="btn btn-dark" id="refresh">
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
                        <th style="text-align:left; width: 5%;">No.</th>
                        <th style="text-align:left">{{ __('Name') }}</th>
                        <th style="text-align:left">Slug</th>
                        <th style="text-align:left">{{ __('Category Type') }}</th>
                        <th style="text-align:center; width: 5%;">{{ __('Action') }}</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@section('script_addon_footer')
    @include('backend.master.category.include.script')
    @include('backend.master.category.include.modal_new')
    @include('backend.master.category.include.modal_edit')
@endsection
