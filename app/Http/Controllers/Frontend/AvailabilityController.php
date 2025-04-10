<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function index(Request $request)
    {
        // Use application's timezone
    $today = Carbon::now(config('app.timezone'))->startOfDay();
    $endDate = $today->copy()->addDays(2)->endOfDay();

    $startDate = $request->query('date')
            ? Carbon::parse($request->query('date'))
            : now()->startOfDay();

        $dates = [
            $startDate->copy(),
            $startDate->copy()->addDay(),
            $startDate->copy()->addDays(2),
        ];

    $availabilities = Availability::with('category')
        ->whereBetween('date', [$today->toDateString(), $endDate->toDateString()])
        ->orderBy('date')
        ->paginate(10);


        return view('frontend.availability.index', compact('availabilities','dates'));
    }

}
