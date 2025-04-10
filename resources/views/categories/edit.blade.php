@extends('adminlte::page')

@section('title', 'Edit Category')

@section('content')
    <form method="POST" action="{{ route('categories.update', $category) }}">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Name</label>
            <input name="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <button class="btn btn-success">Update</button>
    </form>
@endsection
