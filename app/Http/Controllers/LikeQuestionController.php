<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class LikeQuestionController extends Controller
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
    public function store(Request $request, Question $question)
    {

        $question->likes()->attach(['user_id' => $request->user()->id]);

        $request->session()->flash('status', 'question liked');
        return redirect()->back();

    }
}
