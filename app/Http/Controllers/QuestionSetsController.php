<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\AppLibraries\QuestionSetValue;
use App\Models\QuestionSet;
use App\Models\Grouping;
use App\Models\Question;

class QuestionSetsController extends Controller
{
    public function index()
    {
        $allQuestionSet = QuestionSet::all();
        $allQuestionSetValue = [];

        foreach ($allQuestionSet as $questionSet) {
            $groups = Grouping::get();
            $questionsId = [];
            $questionSetValue = [];
    
            foreach ($groups as $group) {
       
                if($group->SetsId ==  $questionSet->id){
                    $questionsId[] = $group->QuestionId;
                }
            
            }
    
            $questions = Question::find($questionsId)->toArray();
    
            $questionSetValue = array(
                "id"=> $questionSet->id,
                "Name"=> $questionSet->Name,
                "QuestionsNum"=> count($questions),
                "Questions"=>  $questions,
            );

            $allQuestionSetValue[] = $questionSetValue;
        };
        return $allQuestionSetValue;

    }

    public function fetch(QuestionSet $questionSet)
    {
        $groups = Grouping::get();
        $questionsId = [];

        $questionSetValue = [];


        foreach ($groups as $group) {
   
            if($group->SetsId ==  $questionSet->id){
                $questionsId[] = $group->QuestionId;
            }
        
        }

        $questions = Question::find($questionsId)->toArray();

        $questionSetValue = array(
            "id"=> $questionSet->id,
            "Name"=> $questionSet->Name,
            "QuestionsNum"=> $questionSet->QuestionsNum,
            "Questions"=>  $questions,
        );


        return $questionSetValue;
    }

    public function store(Request $request)
    {
        return QuestionSet::create($request->all());
    }

    public function update(Request $request, QuestionSet $questionSet)
    {
        $questionSet->update($request->all());

        return $questionSet;
    }

    public function destroy(QuestionSet $questionSet)
     {
        $questionSet->delete();
    
        return $questionSet;
     }
}
