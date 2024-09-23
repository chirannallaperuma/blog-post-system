@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">
                            Blog Posts
                        </div>
                        <a href="{{ route('blogs.create') }}">
                            <button type="button" class="btn btn-success btn-sm">
                                <i class="fa fa-plus"></i> New Blog Post
                            </button>
                        </a>
                    </div>

                    @if (session('alert'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('alert') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <table class="table table-borderless">
                            <thead class="bg-gradient-navy">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-light">
                                @foreach ($blogPosts as $blogPost)
                                    <tr>
                                        <td>{{ $blogPost->id }}</td>
                                        <td>{{ $blogPost->title }}</td>
                                        <td>{{ $blogPost->description }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#blogPostModal-{{ $blogPost->id }}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <button onclick="deletePost({{ $blogPost->id }})"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="blogPostModal-{{ $blogPost->id }}" tabindex="-1"
                                        aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel">Edit Blog Post</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST"
                                                        action="{{ route('blogs.update', $blogPost->id) }}">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group mb-3">
                                                            <label for="title">Title</label>
                                                            <input type="text" name="title" class="form-control"
                                                                value="{{ $blogPost->title }}" required>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="description">Description</label>
                                                            <textarea name="description" class="form-control" required>{{ $blogPost->description }}</textarea>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Update Blog
                                                            Post</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                            
                        </table>
                        {{ $blogPosts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('div.alert').delay(2000).slideUp(300);

        function deletePost(id) {
            Swal.fire({
                title: 'Are You Sure You Want to Delete This Blog Post?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('blogs.delete', ':id') }}".replace(':id', id),
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'json',
                        success: function(results) {
                            if (results.success) {
                                location.reload();
                            } else {
                                Swal.fire("Error!", results.message, "error");
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire("Error!", "Something went wrong: " + error, "error");
                        }
                    });
                }
            });
        }
    </script>
@endsection
