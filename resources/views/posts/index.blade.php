@extends('layouts.master')
@section('content')
    <div class="mt-5">
        {{-- check session --}}
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <h2>Post List</h2>
            {{-- <a href="{{ route('posts.create') }}" class="btn btn-dark ms-3">Create Post</a> --}}
            <button type="button" class="btn btn-dark ms-3" data-bs-toggle="modal" data-bs-target="#postModal">Create Post</button>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Categories</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration + $posts->firstItem() - 1 }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td>
                            @foreach ($post->categories as $category)
                                <span class="badge bg-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ $post->created_at->format('d F Y H:i') }}</td>
                        <td>{{ $post->updated_at->format('d F Y H:i') }}</td>
                        <td>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex">
            {{ $posts->links() }}
        </div>

        <!-- Modal Create Post -->
        <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="postModalLabel">Tambah Postingan Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="postForm" action="/posts/create" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="user_id" class="form-label fw-semibold">User ID</label>
                                <input type="text" class="form-control" id="user_id" name="user_id">
                                <span id="user_id_error" class="invalid-feedback"></span>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label fw-semibold">Title</label>
                                <input type="text" class="form-control" id="title" name="title">
                                <span id="title_error" class="invalid-feedback"></span>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label fw-semibold">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                                <span id="content_error" class="invalid-feedback"></span>
                            </div>
                            <button type="button" id="submitBtn" class="btn btn-dark w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#submitBtn').click(function(e) {
                e.preventDefault();
                let title = $('#title').val();
                let content = $('#content').val();
                let user_id = $('#user_id').val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('posts.ajax-store') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        title: title,
                        content: content,
                        user_id: user_id
                    },
                    success: function(response) {
                        $('#postModal').modal('hide');
                        $('#postForm').trigger('reset');
                        window.location.reload();
                    },
                    error: function(error) {
                        // console.log(error.responseJSON);
                        $.each(error.responseJSON.errors, function(key, value) {
                            $('#' + key ).addClass('is-invalid');
                            $('#' + key + '_error').text(value);
                        });
                    },
                })
            })
        })
    </script>
@endsection