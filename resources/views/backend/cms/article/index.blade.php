@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <div class="btn-group">
                            <a href="{{ route('articles.create') }}" class="btn btn-primary">
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
                                <th style="text-align:left; width: 5%;">No.</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Tags') }}</th>
                                <th style="width: 5%;">{{ __('Publish?') }}</th>
                                <th style="text-align:center; width: 15%;">{{ __('Published At') }}</th>
                                <th style="text-align:center; width: 10%;">{{ __('Action') }}</th>
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
    @include('backend.cms.article.include.script')
@endsection
