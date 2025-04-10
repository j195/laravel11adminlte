<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Category;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function index(Request $request)
    {
        $query = Availability::with('category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $availabilities = $query->latest()->paginate(10); // <- Pagination added
        $categories = Category::all();

        return view('availability.index', compact('availabilities', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('availability.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'interval' => 'required|integer',
        ]);

        Availability::create($request->all());

        return redirect()->route('availability.index')->with('success', 'Availability added.');
    }

}
