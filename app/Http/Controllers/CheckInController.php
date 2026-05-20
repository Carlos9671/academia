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
        $gym = Gym::where('token', $token)->firstOrFail();

        $request->validate([
            'member_id'=> 'required|exists:members,id',
        ]);

        $member = Member::findOrFail($request->member_id);

        $jaFezCheckin = CheckIn::where('member_id', $member->id)
        ->whereDate('checked_in_at', Carbon::today())->exists();

        if ($jaFezCheckin) {
            return back()->with('error', 'Você já fez o check-in hoje!');
        }

        CheckIn::create([
            'member_id' => $member->id,
            'gym_id' => $gym->id,
            'checked_in_at' => Carbon::now(),
        ]);

        $member->last_checkin_at = Carbon::now();
        $member->save();

        $dias_totais = $member->training_days;

        $checkins_semana = CheckIn::where('member_id', $member->id)
            ->whereBetween('checked_in_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek(),
            ])->count();

        if ($checkins_semana >= $dias_totais) {
            $member->streak_current += 1;
            if ($member->streak_current > $member->streak_longest) {
                $member->streak_longest = $member->streak_current;
            }
            $member->save();
            return back()->with('success', "Você completou sua semana! Ofensiva em {$member->streak_current} semanas 🏆");
        }

        return back()->with('success', "Check-in realizado! Você foi {$checkins_semana} de {$dias_totais} da semana 🔥");
    }
}
