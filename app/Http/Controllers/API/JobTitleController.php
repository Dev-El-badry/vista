<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JobTitle;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
class JobTitleController extends Controller
{
    public function get_list() {
    	$list = [];
    	$cdc = JobTitle::where('status', 1)
    	->orderBy('priority', 'asc')->get();

    	foreach ($cdc as $key=>$row) {
    		$list[$key]['id'] = $row->id;
    		$list[$key]['title'] = $row->title;
    	}

    	try {
    		return response()->json(['data'=> $list], 200);
    	} catch (JWTException $e) {
    		return response()->json(['error'=> 'failed to get list please try again!'], 500);
    	}
    	
    }


    public function add_job_title(Request $request) {
    	$validator = Validator::make($request->all(), [
    		'title'=> 'required|string|min:3|max:191|unique:job_titles,title',
    	]);	

    	if($validator->fails())
    		return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

    	try {
    		$cdc = new JobTitle();
    		$cdc->title = $request->title;
    		$cdc->status = 0;
    		$cdc->save();

    		return response()->json(['success'=> true, 'message'=> 'Successfully Job Title has been added!'], 200);
    	} catch (JWTException $e) {
    		return response()->json(['success'=> false, 'error'=> 'failed to add Job Title please try again!'], 500);
    	}
    }
}
