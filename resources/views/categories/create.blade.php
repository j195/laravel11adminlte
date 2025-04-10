@extends('adminlte::page')

@section('title', 'Add Category')

@section('content')
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input name="name" class="form-control" required>
        </div>
        <button class="btn btn-primary">Create</button>
    </form>
@endsection
