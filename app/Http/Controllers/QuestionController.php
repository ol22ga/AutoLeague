<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::query()->paginate(10);

        return response()->json([
            'questions' => $questions->items(),
            'current_page' => $questions->currentPage(),
            'last_page' => $questions->lastPage()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'text' => ['required'],
        ],[
            'text.required' => 'Обязательное поле',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $question = new Question($request->all());
        $question->user_id = Auth::id();
        $question->save();

        return response()->json('OK', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question, Request $request)
    {
        $validate = Validator::make($request->all(), [
            'answer' => ['required'],
        ],[
            'answer.required' => 'Обязательное поле',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $question = Question::query()
            ->where('id', $request->id)
            ->first();

        $question->answer = $request->answer;
        $question->update();

        return response()->json('OK', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question, Request $request)
    {
        $question = Question::query()
            ->where('id', $request->id)
            ->delete();

        return response()->json('OK', 200);
    }
}
