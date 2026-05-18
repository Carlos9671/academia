<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GymController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gyms = gym::all();
        return view('gyms.index', compact('gyms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gyms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'owner_name'=> 'required|string|max:255',
            'phone'=> 'required|string|max:20',
        ]);

        Gym::create([
            'name' => $request->name,
            'owner_name'=> $request->owner_name,
            'phone'=> $request->phone,
            'token'=> Str::uuid(),
        ]);

        return redirect()->route('gyms.index')->with('success','academia cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gym $gym)
    {
        return view('gyms.show', compact('gym'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gym $gym)
    {
        return view('gyms.edit', compact('gym'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gym $gym)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20'
        ]);

        $gym->update($request->only('name','owner_name', 'phone'));

        return redirect()->route('gyms.index')->with('success', 'Academia atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gym $gym)
    {
        $gym->delete();
        return redirect()->route('gyms.index')->with('success','Academia removida com sucesso');
    }
}
