<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        if($this->command->confirm('do you wand to refresh the database?', true))
        {
            $this->command->call('migrate:refresh');
            $this->command->info('database was refreshed!');
        }

        $this->call([
            UserSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            LikesSeeder::class,
        ]);
    }
}
