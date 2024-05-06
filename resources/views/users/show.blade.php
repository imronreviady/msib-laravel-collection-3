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
            <h2>Post List By User</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-dark ms-3">Create Post</a>
        </div>
        <!-- name user -->
        <h2>Nama: {{ $user->name }}</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    {{-- <th>#</th> --}}
                    <th>Title</th>
                    <th>Content</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->posts as $post)
                    <tr>
                        {{-- <td>{{ $loop->iteration + $users->firstItem() - 1 }}</td> --}}
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
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
            {{-- {{ $posts->links() }} --}}
        </div>
    </div>
@endsection