@extends('adminlte::page')

@section('title', 'Availability')

@section('content')
    <h2 class="mb-4">Availability for 3 Days</h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('frontend.availability', ['date' => \Carbon\Carbon::parse($currentDate)->subDays(3)->toDateString()]) }}" class="btn btn-sm btn-primary">Previous</a>
        <a href="{{ route('frontend.availability', ['date' => \Carbon\Carbon::parse($currentDate)->addDays(3)->toDateString()]) }}" class="btn btn-sm btn-primary">Next</a>
    </div>

    <div class="row">
        @foreach($dates as $date)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ $date->format('l, M d') }}</strong>
                    </div>
                    <div class="card-body">
                        @forelse($availabilities[$date->toDateString()] ?? [] as $availability)
                            <div class="mb-2">
                                <strong>{{ $availability->category->name ?? 'N/A' }}</strong><br>
                                {{ $availability->start_time }} - {{ $availability->end_time }} <br>
                                Interval: {{ $availability->interval }} minutes
                            </div>
                        @empty
                            <p>No availability</p>
                        @endforelse
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
