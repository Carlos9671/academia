<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            ['gym_id' => 1, 'name' => 'Lucas Oliveira', 'phone' => '27991110001', 'training_days' => 3],
            ['gym_id' => 1, 'name' => 'Fernanda Costa', 'phone' => '27991110002', 'training_days' => 4],
            ['gym_id' => 2, 'name' => 'Rafael Mendes', 'phone' => '27991110003', 'training_days' => 5],
            ['gym_id' => 2, 'name' => 'Juliana Freitas', 'phone' => '27991110004', 'training_days' => 2],
            ['gym_id' => 3, 'name' => 'Bruno Alves', 'phone' => '27991110005', 'training_days' => 3],
            ['gym_id' => 3, 'name' => 'Camila Nunes', 'phone' => '27991110006', 'training_days' => 4],
            ['gym_id' => 4, 'name' => 'Diego Martins', 'phone' => '27991110007', 'training_days' => 5],
            ['gym_id' => 4, 'name' => 'Larissa Barros', 'phone' => '27991110008', 'training_days' => 3],
            ['gym_id' => 5, 'name' => 'Thiago Carvalho', 'phone' => '27991110009', 'training_days' => 2],
            ['gym_id' => 5, 'name' => 'Isabela Ferreira', 'phone' => '27991110010', 'training_days' => 4],
        ];

        foreach ($members as $member) {
            Member::create([
                'gym_id' => $member['gym_id'],
                'name' => $member['name'],
                'phone' => $member['phone'],
                'training_days' => $member['training_days'],
                'password' => bcrypt('123456'),
            ]);
        }
    }
}