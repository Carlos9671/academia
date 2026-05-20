<?php

namespace App\Console\Commands;

use App\Models\Member;
use App\Models\CheckIn;
use App\Models\StreakLoss;
use Illuminate\Console\Command;
use Carbon\Carbon;


class VerificarOfensivas extends Command
{
    protected $signature = "ofensivas:verificar";
    protected $description = "verifica se os alunos completaram a semana e zera a ofensiva se caso não completaram";
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $semanaPassada = [
            Carbon::now()->subWeek()->startOfWeek(),
            Carbon::now()->subWeek()->endOfWeek(),
        ];

        $members = Member::where('active', true)->get();

        foreach ($members as $member) {
            $checkins = CheckIn::where('member_id',$member->id)
                ->wherebetween('checked_in_at', $semanaPassada)->count();

            if ($checkins < $member->training_days && $member->streak_current > 0) {
                StreakLoss::create([
                    'member_id' => $member->id,
                    'streak_current'=> $member->streak_current,
                    'lost_at' => Carbon::now(),
                ]);

                $member->streak_current = 0;
                $member->save();

                $this->info("Ofensiva zerada: {$member->name}");
                
            }
        }
    }
}
