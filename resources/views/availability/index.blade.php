@extends('adminlte::page')

@section('title', 'Availability List')

@section('content_header')
    <h1>Availability List</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('availability.index') }}" class="mb-4">
        <div class="form-group">
            <label>Filter by Category:</label>
            <select name="category" class="form-control">
                <option value="">All</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Filter</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Category</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Interval (mins)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($availabilities as $availability)
                <tr>
                    <td>{{ $availability->category->name }}</td>
                    <td>{{ $availability->date }}</td>
                    <td>{{ $availability->start_time }}</td>
                    <td>{{ $availability->end_time }}</td>
                    <td>{{ $availability->interval }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        <p class="text-muted">
            Showing {{ $availabilities->firstItem() }} to {{ $availabilities->lastItem() }} of
            {{ $availabilities->total() }} entries
        </p>
        {{ $availabilities->links() }}
    </div>
@endsection
