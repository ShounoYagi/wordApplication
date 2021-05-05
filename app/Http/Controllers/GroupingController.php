<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grouping;
use Carbon\Carbon;

class GroupingController extends Controller
{
    public function store(Request $request)
    {
        $storedGrouping = [];
        foreach ($request->all() as $key => $groupingData) {
            $grouping = new Grouping;
            $grouping->QuestionId = $groupingData['QuestionId'];
            $grouping->SetsId = $groupingData['SetsId'];
            $grouping->created_at = Carbon::now();
            $grouping->updated_at = Carbon::now();
            $storedGrouping[] = $grouping->save();
        }

        if($storedGrouping == null){
            return response()->apiResponse(20100 , "失敗" ,"問題グループの登録に失敗しました");
        }else{
            return response()->apiResponse(20000 , "成功" ,"問題グループの登録に成功しました" ,$request->all());
        }
    }

    public function update(Request $request)
    {
        $storedGrouping = [];
        foreach ($request->all() as $key => $groupingData) {
            $grouping = new Grouping;
            $grouping->QuestionId = $groupingData['QuestionId'];
            $grouping->SetsId = $groupingData['SetsId'];
            $grouping->created_at = Carbon::now();
            $grouping->updated_at = Carbon::now();
            $storedGrouping[] = $grouping->save();
        }

        if($storedGrouping == null){
            return response()->apiResponse(20100 , "失敗" ,"問題グループの登録に失敗しました");
        }else{
            return response()->apiResponse(20000 , "成功" ,"問題グループの登録に成功しました" ,$request->all());
        }
    }

    public function destroy(Request $request ,$setsId)
    {

        $targetGrouping = Grouping::where('SetsId',$setsId)->get();

        foreach ($targetGrouping as $key => $groupingData) {
            \Debugbar::info($groupingData);
            $groupingData->delete();
        }

        if($targetGrouping == null){
            return response()->apiResponse(20100 , "失敗" ,"問題グループの削除に失敗しました");
        }else{
            return response()->apiResponse(20000 , "成功" ,"問題グループの削除に成功しました" ,$targetGrouping);
        }
    }
}
