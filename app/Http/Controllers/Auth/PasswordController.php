<?php

namespace App\Http\Controllers\Auth;

use App\Models\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('auth.password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'senha_atual' => 'required|string',
            'nova_senha' => 'required|string|min:6|confirmed',    
        ]);

        if (!Hash::check($request->senha_atual, Auth::user()->password)) {
            return back()->withErrors(['senha_atual' => 'Senha atual incorreta.']);
        }

        $member = Member::find(Auth::id());
        $member->password = bcrypt($request->nova_senha);
        $member->save();

        return redirect()->route('app.home')->with('success', "Senha alterada com sucesso!");
    }
}
