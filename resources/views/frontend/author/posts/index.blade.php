@extends('frontend.layouts.app')

@section('content')
    <section id="latest-post">
        <div class="container mb-3">
            <h1>{{ $page_title }}</h1>
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('author.posts.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> New</a>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <th>No.</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($posts as $index => $posts)
                                    <tr>
                                        <td style="width: 50px; text-align:center">{{ $index + 1 }}</td>
                                        <td>{{ $posts->title }}</td>
                                        <td>{{ $posts->category->name }}</td>
                                        <td style="width: 100px; text-align:center">
                                            <form action="{{ route('author.posts.destroy', $posts->id) }}" method="POST"
                                                class="d-inline delete-data">
                                                <div class="btn-group">
                                                    <a href="{{ route('posts.show', ['slug' => $posts->slug]) }}" class="btn btn-primary">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('author.posts.edit', $posts->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="fa fa-pencil-alt"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" title='Delete'>
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script_addon')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs5/datatables.min.css') }}">
    <script src="{{ asset('assets/plugins/datatables-bs5/datatables.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                aaSorting: [
                    [0, 'desc']
                ],
                columnDefs: [{
                        targets: -1,
                        orderable: false
                    } // Menonaktifkan urutan untuk kolom terakhir
                ],
            });
        });
    </script>
@endsection
