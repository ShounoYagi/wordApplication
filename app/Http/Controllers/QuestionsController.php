<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionsController extends Controller
{
    public function index()
    {
        return Question::all();
    }

    public function show(Question $question)
    {
        return $question;
    }

    public function store(Request $request)
    {
        return Question::create($request->all());
    }

    public function update(Request $request, Question $question)
    {
        $question->update($request->all());

        return $question;
    }

    public function destroy(Question $question)
     {
        $question->delete();
    
        return $question;
     }
}
