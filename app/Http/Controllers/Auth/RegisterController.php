<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     */
    protected $redirectTo = '/dashboard'; // customize if needed

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'    => ['required', 'string', 'min:8', 'confirmed'],
            'cu'          => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'department'  => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data)
    {
        return User::create([
            'name'        => $data['name'],
            'email'       => $data['email'],
            'password'    => Hash::make($data['password']),
            'cu'          => $data['cu'],
            'designation' => $data['designation'],
            'department'  => $data['department'],
            'role'        => 'user', // default role on public registration
        ]);
        // event(new Registered($user)); // 🔐 Send verification email

         return $user;
    }

            protected function redirectTo()
        {
            $role = auth()->user()->role;

            return match ($role) {
                'administrator' => '/admin/dashboard',
                'editor'        => '/editor/dashboard',
                default         => '/user/dashboard',
            };
        }
}
