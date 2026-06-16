<?php

namespace App\Console\Commands;

use App\Models\Gym;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RenovarTokensCheckin extends Command
{
    protected $signature = 'tokens:renovar';
    protected $description = 'Renova os tokens de check-in de todas as academias';

    public function handle()
    {
        $gyms = Gym::all();

        foreach ($gyms as $gym) {
            $gym->daily_token = Str::uuid();
            $gym->daily_token_date = Carbon::today();
            $gym->save();
        }

        $this->info('Tokens renovados com sucesso.');
    }
}