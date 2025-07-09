<?php

// app/Http/Controllers/Admin/AdminRentalController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReleaseRequest;
use App\Models\Equipment;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminRentalController extends Controller
{
    public function index()
    {
        $requests = ReleaseRequest::with(['user', 'equipment'])->latest()->get();
        return view('admin.rentals.index', compact('requests'));
    }

    public function show($id)
    {
        $request = ReleaseRequest::with(['user', 'equipment'])->findOrFail($id);
        return view('admin.rentals.show', compact('request'));
    }

    public function approve($id)
    {
        $request = ReleaseRequest::findOrFail($id);

        if ($request->status !== 'pending') {
            return back()->with('error', 'Only pending requests can be approved.');
        }

        $request->status = 'approved';
        $request->date_approved = now();
        $request->save();

        $request->equipment->update(['available' => false]);

        return redirect()->route('admin.rentals.index')->with('success', 'Request approved.');
    }

    public function decline($id)
    {
        $request = ReleaseRequest::findOrFail($id);

        if ($request->status !== 'pending') {
            return back()->with('error', 'Only pending requests can be declined.');
        }

        $request->status = 'declined';
        $request->save();

        return redirect()->route('admin.rentals.index')->with('info', 'Request declined.');
    }

    public function markReturned($id)
    {
        $request = ReleaseRequest::findOrFail($id);

        if ($request->status !== 'approved') {
            return back()->with('error', 'Only approved requests can be returned.');
        }

        $request->status = 'returned';
        $request->date_returned = now();
        $request->save();

        $request->equipment->update(['available' => true]);

        return redirect()->route('admin.rentals.index')->with('success', 'Marked as returned.');
    }

    public function downloadForm($id)
    {
        $request = ReleaseRequest::with(['user', 'equipment'])->findOrFail($id);

        $pdf = Pdf::loadView('admin.rentals.form', compact('request'));
        return $pdf->download('RentalForm_Request_' . $id . '.pdf');
    }
}
