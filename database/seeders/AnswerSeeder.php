<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answersCount = $this->command->ask('how many answers whould you like?', 60);

        $users = User::all();
        $questions = Question::all();

        Answer::factory($answersCount)->make()->each(function($answer) use ($users, $questions){
            $answer->user_id = $users->random()->id;
            $answer->question_id = $questions->random()->id;
            $answer->save();
        });
    }
}
