<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnswer $request, Question $question)
    {

        $question->answers()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id,
        ]);

        $request->session()->flash('status', 'answer posted');
        return redirect()->back();


        // $validatedData = $request->validated();
        // $validatedData['user_id'] = $request->user()->id;
        // $question = Question::create($validatedData);

        // $request->session()->flash('status', 'question created');
        // return redirect()->route('questions.show', ['question' => $question->id]);
    }

}
