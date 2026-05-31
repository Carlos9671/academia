<?php

namespace Database\Seeders;

use App\Models\Gym;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GymSeeder extends Seeder
{
    public function run(): void
    {
        $gyms = [
            ['name' => 'Academia FitLife', 'owner_name' => 'João Silva', 'phone' => '27999110001'],
            ['name' => 'PowerGym', 'owner_name' => 'Maria Souza', 'phone' => '27999110002'],
            ['name' => 'Iron House', 'owner_name' => 'Pedro Santos', 'phone' => '27999110003'],
            ['name' => 'Academia Força Total', 'owner_name' => 'Ana Lima', 'phone' => '27999110004'],
            ['name' => 'BodyFit Studio', 'owner_name' => 'Carlos Rocha', 'phone' => '27999110005'],
        ];

        foreach ($gyms as $gym) {
            Gym::create([
                'name' => $gym['name'],
                'owner_name' => $gym['owner_name'],
                'phone' => $gym['phone'],
                'token' => Str::uuid(),
            ]);
        }
    }
}