@extends('frontend.layouts.app')

@section('content')
    <section id="latest-post">
        <div class="container mb-3">
            <h1>{{ $page_title }}</h1>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-warning">Latest Post</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th>No.</th>
                                        <th>Title</th>
                                        <th>Created At</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($recent_posts as $index => $posts)
                                            <tr>
                                                <td style="width: 50px; text-align:center">{{ $index + 1 }}</td>
                                                <td>{{ $posts->title }}</td>
                                                <td>{{ $posts->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-primary text-light">Popular Post</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>No.</th>
                                        <th>Title</th>
                                        <th>View</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($recent_posts as $index => $posts)
                                            <tr>
                                                <td style="width: 50px; text-align:center">{{ $index + 1 }}</td>
                                                <td>{{ $posts->title }}</td>
                                                <td>{{ rand(0, 150)}}x</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
