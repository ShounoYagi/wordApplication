<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Validator;

class QuestionsController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        if($questions == null){
            return response()->apiResponse(20100 , "失敗","問題の取得に失敗しました");
        }else{
            return response()->apiResponse(20000 , "成功","問題の取得に成功しました" ,$questions);
        }
        
    }

    public function show(Question $question)
    {
        if($question == null){
            return response()->apiResponse(20100 , "失敗","問題の取得に失敗しました");
        }else{
            return response()->apiResponse(20000 , "成功","問題の取得に成功しました" ,$question);
        }

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'QuestionText' => 'required',
            'Answer' =>'required',
            'Category1' =>'required',
        ]);

        if ($validator->fails()) {
            return response()->apiResponse(20100 , "バリデーションエラー",$validator->errors()->all() ,[]);
        }else {
            $questions = Question::create($request->all());
            return response()->apiResponse(20000 , "成功" ,"問題登録を成功しました。" ,$questions);
        }
    }

    public function update(Request $request, Question $question)
    {
        $validator = Validator::make($request->all(), [
            'QuestionText' => 'required',
            'Answer' =>'required',
            'Category1' =>'required',
        ]);

        if ($validator->fails()) {
            return response()->apiResponse(20100 , "バリデーションエラー",$validator->errors()->all() ,[]);
        }else {
            $question->update($request->all());
            return response()->apiResponse(20000 , "成功" ,"問題の更新に成功しました。" ,$request->all());
        }

    }

    public function destroy(Question $question)
     {
        $isDelete = $question->delete();

        if ($isDelete) {
            return response()->apiResponse(20000 , "成功" ,"問題の削除に成功しました。" ,$question);
           
        }else {
            return response()->apiResponse(20100 , "失敗","問題の削除に失敗しました。");
        }

     }
}
