<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessModel;
use Validator, DB;

class BusinessModelController extends Controller
{
    public function update_profile(Request $request, $user_id) {
    	$validator = Validator::make($request->all(), [
    		'bio'=> 'sometimes|nullable|string|min:3|max:255',
    		'timer_mins'=> 'sometimes|nullable|numeric',
    		'timer_hours'=> 'sometimes|nullable|numeric',
    		'timer_days'=> 'sometimes|nullable|numeric',
    		'cost'=> 'sometimes|nullable|numeric',
    		'cost_visit'=> 'sometimes|nullable|numeric',
    		'degree'=> 'sometimes|nullable|string',
    		'status'=> 'sometimes|nullable|numeric',

    	]);

        if($validator->fails())
            return response()->json(['success'=> false, 'errors'=> $validator->errors()], 401);

        $bm = BusinessModel::where('user_id', $user_id)->first();
        $bm->bio = $request->bio;
        $bm->timer_mins = $request->timer_mins;
        $bm->timer_mins = $request->timer_mins;
        $bm->timer_hours = $request->timer_hours;
        $bm->timer_days = $request->timer_days;
        $bm->cost = $request->cost;
        $bm->cost_visit = $request->cost_visit;
        $bm->degree = $request->degree;
        $bm->status = $request->status;
        $bm->lat = $request->lat;
        $bm->long = $request->long;
        $bm->save();

        return response()->json(['success'=>true, 'message'=> 'Successfully Update Profile !'], 200);
    }

    public function show_profile($user_id) {
        if(!is_numeric($user_id))
            return response()->json(['success'=> false, 'message'=> 'not allowed to be here'], 401);

        $bm = BusinessModel::where('user_id', $user_id)->first();
        return response()->json(['success'=>true, 'data'=> $bm->toArray()], 200);
    }
}
