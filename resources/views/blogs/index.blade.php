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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
