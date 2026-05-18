<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'phone' => 'required|string',
        'password' => 'required|string',
    ]);

    $member = Member::where('phone', $request->phone)->first();

    if (!$member || !Hash::check($request->password, $member->password)) {
        return back()->withErrors([
            'phone' => 'Telefone ou senha incorretos.',
        ]);
    }

    Auth::guard('web')->login($member, true);

    $request->session()->regenerate();

    return redirect()->intended(route('app.home'));
}

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}