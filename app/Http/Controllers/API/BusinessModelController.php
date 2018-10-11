<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessModel;
use App\RequestChat;
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

    public function public_profile($bm_id, $user_id) {
        //do something
        $bm = BusinessModel::where('id', $bm_id)->first();
        $status = DB::table('request_chats')->where('bm_id', $bm_id)->where('user_id', $user_id)->first();
        
        if($status->dr_approve == 0) {
            $title = 0;
        } elseif($status->dr_approve == 2) {
            $title = 2;
        } elseif(($status->dr_approve == 1)) {
            $title = 1;
        }
        //0 is refused, 1 is approve, 2 is refused
        return response()->json(['success'=>true, 'data'=> $bm, 'status'=>$title], 200);
    }

    public function show_vista_wating($bm_id) {
        $bm = BusinessModel::where('id', $bm_id)->with('vista_wating')->first();
        return response()->json(['success'=> true, 'data'=>$bm->vista_wating], 200);
    }

    public function show_vista_running($bm_id) {
        $bm = BusinessModel::where('id', $bm_id)->with('vista_running')->first();
        return response()->json(['success'=> true, 'data'=>$bm->vista_running], 200);
    }

    public function show_vista_fails($bm_id) {
        $bm = BusinessModel::where('id', $bm_id)->with('vista_fails')->first();
        return response()->json(['success'=> true, 'data'=>$bm->vista_fails], 200);
    }   

    public function show_vista_done($bm_id) {
        $bm = BusinessModel::where('id', $bm_id)->with('vista_done')->first();
        return response()->json(['success'=> true, 'data'=>$bm->vista_done], 200);
    }

    public function submit_action(Request $request, $bm_id) {
        //NOTE: Update dr_approve in request_chat table
        $bm = RequestChat::where('bm_id', $bm_id)->first();
        $bm->dr_approve = $request->approve; // 0 is default mean no action till now, 1 mean approve, 2 mean refused
        $bm->save();

        return response()->json(['success'=> true, 'message'=> 'Successfully Update Status of request !'], 200);
    }
}
