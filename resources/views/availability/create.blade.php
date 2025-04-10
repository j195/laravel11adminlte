@extends('adminlte::page')

@section('title', 'Create Availability')

@section('content_header')
    <h1>Create Availability</h1>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('availability.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Start Time</label>
            <input type="time" name="start_time" class="form-control" required>
        </div>

        <div class="form-group">
            <label>End Time</label>
            <input type="time" name="end_time" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Interval (minutes)</label>
            <input type="number" name="interval" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
