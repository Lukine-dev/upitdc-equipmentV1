<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Equipment;
use App\Models\ReleaseRequest;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
           // User stats
    $totalUsers = User::count();
    $totalAdmins = User::where('role', 'administrator')->count();
    $totalEditors = User::where('role', 'editor')->count();
    $unverifiedUsers = User::whereNull('email_verified_at')->count();
    $recentUsers = User::latest()->take(5)->get();

    // Equipment stats
    $totalEquipment = Equipment::count();
    $availableEquipment = Equipment::where('status', 'available')->count();
    $unavailableEquipment = Equipment::where('status', 'unavailable')->count();
    $reservedEquipment = Equipment::where('status', 'reserved')->count();

    // Rental requests list (this fixes the error)
    $requests = ReleaseRequest::with(['user', 'equipment'])->latest()->get();
    

        // ✅ This is the missing variable   
    $requestsByStatus = ReleaseRequest::selectRaw('status, COUNT(*) as count')
        ->groupBy('status')
        ->pluck('count', 'status')
        ->toArray(); // ← Ensure it's an array


    return view('admin.dashboard', compact(
        'totalUsers',
        'totalAdmins',
        'totalEditors',
        'unverifiedUsers',
        'recentUsers',
        'totalEquipment',
        'availableEquipment',
        'unavailableEquipment',
        'reservedEquipment',
        'requestsByStatus',
        'requests' // 👈 make sure this is included!
    ));
    }
}
