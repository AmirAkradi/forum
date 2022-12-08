<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount = User::all()->count();

        Answer::all()->each(function (Answer $answer) use ($usersCount){
            $take = random_int(0, $usersCount);
            $users = User::inRandomOrder()->take($take)->get()->pluck('id');
            $answer->likes()->sync($users);
        });

        Question::all()->each(function (Question $question) use ($usersCount){
            $take = random_int(0, $usersCount);
            $users = User::inRandomOrder()->take($take)->get()->pluck('id');
            $question->likes()->sync($users);   
        });
    }
}
