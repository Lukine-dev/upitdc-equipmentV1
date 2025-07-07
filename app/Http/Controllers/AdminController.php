<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'administrator')->count();
        $totalEditors = User::where('role', 'editor')->count();
        $unverifiedUsers = User::whereNull('email_verified_at')->count();

        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalEditors',
            'unverifiedUsers',
            'recentUsers'
        ));
    }
}