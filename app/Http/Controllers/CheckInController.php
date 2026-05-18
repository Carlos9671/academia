<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gym;
use App\Models\Member;
use App\Models\CheckIn;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckInController extends Controller
{
    public function show($token)
    {
        $gym = Gym::where('token', $token)->firstOrFail();
        $members = $gym->members()->where('active', 'True')->get();
        return view('checkin.show', compact('gym', 'members'));
    }

    public function store(Request $request, $token)
    {
        $gym = Gym::where('token', $token)->firtOrFail();

        $request->validate([
            'member_id'=> 'required|exists:members_id',
        ]);

        $member = Member::findOrFail($request->member_id);

        $jaFezCheckin = Checkin::where('member_id', $meber->id)
        ->whereDate('checked_in_at', Carbon::today())->exists();

        if ($jaFezCheckin) {
            return back()->with('error', 'Você já fez o check-in hoje!');
        }

        CheckIn::create([
            'member_id' => $member->id,
            'gym_id' => $gym->id,
            'checked_in_at' => Carbon::now(),
        ]);

        $ultimoCheckin = $member->last_checkin_at;
        $ontem = Carbon::yesterday()->startofDay();

        if ($ultimoCheckin && Carbon::parse($ultimoCheckin)->greaterThanOrEqualTo($ontem)) {
            $member->streak_current += 1;
        } else {
            $member->streak_current = 1;
        }

        if ($member->streak_current > $member->streak_longest) {
            $member->streak_longest = $member->streak_current;
        }

        $member->last_checkin_at = Carbon::now();
        $member->save();

        return back()->with('success', 'Check-in realizado! Sua ofensiva está em {$member->streak_current} dias 🔥');
    }
}
