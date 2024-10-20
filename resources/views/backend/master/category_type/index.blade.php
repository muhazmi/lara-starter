@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col">
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
                                <th style="text-align: center; width: 5%;">No.</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Slug') }}</th>
                                <th style="text-align: center; width: 10%;">{{ __('Action') }}</th>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@section('script_addon_footer')
    @include('backend.master.category_type.include.script')
    @include('backend.master.category_type.include.modal_new')
    @include('backend.master.category_type.include.modal_edit')
@endsection
