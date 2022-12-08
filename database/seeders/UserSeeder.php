<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userCount = $this->command->ask('how many user whould you like', 5);

        User::factory($userCount)->create();
        User::factory()->create([
            'name' => 'test',
            'email' => 'test@forum.com',
            'username' => 'test',
        ]);
    }
}
