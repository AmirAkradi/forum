<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestion;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'update', 'store', 'edit', 'destoy']);
        // $this->authorizeResource(Question::class, 'question');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $this->authorize('viewAny', Question::class);
        return view('questions.index', [
            'questions' => Question::orderedByLike()->with('user')->withCount('answers')->withCount('likes')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Question::class);
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestion $request)
    {
        $this->authorize('create', Question::class);
        $validatedData = $request->validated();
        $validatedData['user_id'] = $request->user()->id;
        $question = Question::create($validatedData);

        $request->session()->flash('status', 'question created');
        return redirect()->route('questions.show', ['question' => $question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        // $this->authorize('view', $question);
        // $question = Question::findOrFail($id);

        return view('questions.show', [
            'question' => $question,//Question::findOrFail($id),
            'answers' => $question->answers()->with('user')->with('likes')->paginate(3)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $this->authorize('update', $question);
        return view('questions.edit', ['question' => $question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestion $request, Question $question)
    {
        // $question = Question::findOrFail($id);
        $this->authorize('update', $question);
        // $this->authorize('update', $question);

        $validatedData = $request->validated();
        $question->fill($validatedData);
        $question->save();

        $request->session()->flash('status', 'question updated');
        return redirect()->route('questions.show', ['question' => $question->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Question $question)
    {

        $this->authorize('delete', $question);
        // $question = Question::findOrFail($id);

        // $this->authorize($question);

        $question->delete();

        $request->session()->flash('status', 'post deleted!');
        return redirect()->route('questions.index');
    }
}
