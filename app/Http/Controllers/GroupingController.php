<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grouping;
use Carbon\Carbon;

class GroupingController extends Controller
{
    public function store(Request $request)
    {
        foreach ($request->all() as $key => $groupingData) {
            $grouping = new Grouping;
            $grouping->QuestionId = $groupingData['QuestionId'];
            $grouping->SetsId = $groupingData['SetsId'];
            $grouping->created_at = Carbon::now();
            $grouping->updated_at = Carbon::now();
            $grouping->save();
        }
    }

    public function update(Request $request)
    {
        foreach ($request->all() as $key => $groupingData) {
            $grouping = new Grouping;
            $grouping->QuestionId = $groupingData['QuestionId'];
            $grouping->SetsId = $groupingData['SetsId'];
            $grouping->created_at = Carbon::now();
            $grouping->updated_at = Carbon::now();
            $grouping->save();
        }
    }

    public function destroy(Request $request ,$setsId)
    {

        $targetGrouping = Grouping::where('SetsId',$setsId)->get();

        foreach ($targetGrouping as $key => $groupingData) {
            \Debugbar::info($groupingData);
            $groupingData->delete();
        }
    }
}
