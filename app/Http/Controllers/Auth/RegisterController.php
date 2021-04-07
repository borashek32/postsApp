<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.index');
    }

    public function store(Request $request)
    {
        //register user

        $this->validate($request, [
            'name'     => 'required|max:100',
            'username' => 'required|max:100',
            'email'    => 'required|email||max:100',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //log in user

        auth()->attempt([
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('dashboard');
    }
}
