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

        if($allQuestionSetValue == null){
            return response()->apiResponse(20100 , "失敗" ,"問題セットの取得に失敗しました");
        }else{
            return response()->apiResponse(20000 , "成功" ,"問題セットの取得に成功しました" ,$allQuestionSetValue);
        }

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

        if($questionSetValue == null){
            return response()->apiResponse(20100 , "失敗" ,"問題セットの取得に失敗しました");
        }else{
            return response()->apiResponse(20000 , "成功" ,"問題セットの取得に成功しました" ,$questionSetValue);
        }
    }

    public function store(Request $request)
    {
        $questionSet = QuestionSet::create($request->all());

        if($questionSet == null){
            return response()->apiResponse(20100 , "失敗" ,"問題セットの登録に失敗しました");
        }else{
            return response()->apiResponse(20000 , "成功" ,"問題セットの登録に成功しました" ,$questionSet);
        }
    }

    public function update(Request $request, QuestionSet $questionSet)
    {
        $questionSet->update($request->all());

        if($questionSet == null){
            return response()->apiResponse(20100 , "失敗" ,"問題セットの更新に失敗しました");
        }else{
            return response()->apiResponse(20000 , "成功" ,"問題セットの更新に成功しました" ,$questionSet);
        }
    }

    public function destroy(QuestionSet $questionSet)
     {
        $questionSet->delete();

        if($questionSet == null){
            return response()->apiResponse(20100 , "失敗" ,"問題セットの削除に失敗しました");
        }else{
            return response()->apiResponse(20000 , "成功" ,"問題セットの削除に成功しました" ,$questionSet);
        }
     }
}
