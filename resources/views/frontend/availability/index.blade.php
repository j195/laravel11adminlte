<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Availability</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .availability-box {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 2px 2px 8px #ccc;
        }
    </style>
</head>

<body>
    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Admin Log in
                    </a>

                    @if (Route::has('register'))
                        <!--<a href="{{ route('register') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Register
                            </a>-->
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    <div class="container mt-4">
        <h2 class="mb-4">Admin Availabilities</h2>

        <div class="d-flex justify-content-between mb-4">
            <a href="{{ route('frontend.availability', ['date' => $dates[0]->copy()->subDays(3)->toDateString()]) }}"
                class="btn btn-outline-primary">Previous</a>
            <a href="{{ route('frontend.availability', ['date' => $dates[0]->copy()->addDays(3)->toDateString()]) }}"
                class="btn btn-outline-primary">Next</a>
        </div>

        @foreach ($dates as $date)
            <h5>{{ $date->format('l, F j, Y') }}</h5>

            @php
                $dayAvailabilities = $availabilities->where('date', $date->toDateString());
            @endphp

            @forelse ($dayAvailabilities as $availability)
                <div class="availability-box">
                    <strong>Category:</strong> {{ $availability->category->name ?? 'N/A' }}<br>
                    <strong>Start:</strong> {{ \Carbon\Carbon::parse($availability->start_time)->format('h:i A') }}<br>
                    <strong>End:</strong> {{ \Carbon\Carbon::parse($availability->end_time)->format('h:i A') }}<br>
                    <strong>Interval:</strong> {{ $availability->interval }} mins<br>
                    <strong>Slots:</strong><br>
                    @php
                        $start = \Carbon\Carbon::parse($availability->start_time);
                        $end = \Carbon\Carbon::parse($availability->end_time);
                        $interval = $availability->interval; // in minutes
                    @endphp

                    <ul>
                        @while ($start->lt($end))
                            @php
                                $slotTime = $start->copy();
                                $start->addMinutes($interval);
                            @endphp
                            <li>
                                {{ $slotTime->format('h:i A') }} - Available
                            </li>
                        @endwhile
                    </ul>
                </div>
            @empty
                <p>No availabilities for this date.</p>
            @endforelse
        @endforeach
    </div>
</body>

</html>
