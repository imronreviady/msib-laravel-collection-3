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
            <h2>User List</h2>
            <a href="{{ route('users.create') }}" class="btn btn-dark ms-3">Create User</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Phone Number</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration + $users->firstItem() - 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->profile->age }}</td>
                        <td>{{ $user->profile->phone_number }}</td>
                        <td>{{ $user->created_at->format('d F Y H:i') }}</td>
                        <td>{{ $user->updated_at->format('d F Y H:i') }}</td>
                        <td>
                            <a href="{{ route('posts.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('posts.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                            </form>
                            <!-- Show Detail -->
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">Show Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex">
            {{ $users->links() }}
        </div>
    </div>
@endsection