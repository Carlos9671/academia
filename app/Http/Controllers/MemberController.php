<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\Member;
use Faker\Guesser\Name;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::with('gym')->get();
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gyms = Gym::all();
        return view('members.create', compact('gyms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gym_id' => 'required|exists:gyms,id',
            'name'=> 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'training_days' => 'required|integer|min:1|max:5'
        ]);

        Member::create([
            'gym_id' => $request->gym_id,
            'name'=> $request->name,
            'phone'=> $request->phone,
            'training_days' => $request->training_days,
        ]);

        return redirect()->route('members.index')->with('success', 'Aluno cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        $gyms = Gym::all();
        return view('members.edit', compact('member','gyms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',~
            'phone' => 'required|string|max:20',
            'training_days' => 'required|integer|min:1|max:5',
        ]);

        $member->update($request->only('name','phone','training_days'));

        return redirect()->route('members.index')->with('success', 'Aluno atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Aluno removido com sucesso');
    }
}
