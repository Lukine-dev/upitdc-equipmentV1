<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // ✅ List all administrators and editors
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'name'); // default sort
        $direction = $request->input('direction', 'asc');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('role', 'like', "%$search%");
            })
            ->orderBy($sortBy, $direction)
            ->paginate(10)
            ->appends([
                'search' => $search,
                'sort_by' => $sortBy,
                'direction' => $direction,
            ]);

        return view('admin.users.index', compact('users', 'search', 'sortBy', 'direction'));
    }

    // ✅ Show create form
    public function create()
    {
        return view('admin.users.create');
    }

    // ✅ Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users',
            'password'    => 'required|min:8|confirmed',
            'role'        => 'required|in:administrator,editor',
            'cu'          => 'required|string',
            'designation' => 'required|string',
            'department'  => 'required|string',
        ]);

        User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'role'        => $request->role,
            'cu'          => $request->cu,
            'designation' => $request->designation,
            'department'  => $request->department,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.users.index')->with('message', 'User created successfully.');
    }

    // SEARCH
    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('role', 'like', "%{$query}%")
                    ->orderBy('name')
                    ->limit(20)
                    ->get();

        return response()->json([
            'html' => view('admin.users.partials.table', compact('users'))->render()
        ]);
    }



    // ✅ Show edit form
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // ✅ Update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $user->id,
            'password'    => 'nullable|min:8|confirmed',
            'role'        => 'required|in:administrator,editor',
            'cu'          => 'required|string',
            'designation' => 'required|string',
            'department'  => 'required|string',
        ]);

        $user->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'role'        => $request->role,
            'cu'          => $request->cu,
            'designation' => $request->designation,
            'department'  => $request->department,
            'password'    => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('admin.users.index')->with('message', 'User updated.');
    }

    // ✅ Delete user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('message', 'User deleted.');
    }
}
