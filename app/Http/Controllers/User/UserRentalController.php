<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\ReleaseRequest;
use Illuminate\Support\Facades\Auth;

class UserRentalController extends Controller
{
    public function index()
    {
        $requests = ReleaseRequest::where('user_id', Auth::id())->with('equipment')->latest()->get();
        return view('user.rentals.index', compact('requests'));
    }

    public function create()
    {
        $equipment = Equipment::where('status', 'available')->get();
        return view('user.rentals.create', compact('equipment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'purpose' => 'required|string|max:1000',
            'release_date' => 'required|date|after_or_equal:today',
        ]);

        ReleaseRequest::create([
            'user_id' => Auth::id(),
            'equipment_id' => $request->equipment_id,
            'purpose' => $request->purpose,
            'release_date' => $request->release_date,
            'status' => 'pending',
        ]);

        return redirect()->route('user.rentals.index')->with('success', 'Request submitted successfully.');
    }
}
