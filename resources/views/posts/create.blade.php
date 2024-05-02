@extends('layouts.master')
@section('content')
<div class="mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Post List</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-dark ms-3">Create Post</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">Plese check the form below for errors</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" id="title" name="title">
                    {{-- check error --}}
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control {{$errors->has('content') ? 'is-invalid' : ''}}" id="content" name="content" rows="3"></textarea>
                    @if ($errors->has('content'))
                        <div class="invalid-feedback">
                            {{ $errors->first('content') }}
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-dark w-100">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection