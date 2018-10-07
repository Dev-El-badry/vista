<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ChronicDiseaseCategory;
use JWTFactory;
use JWTAuth;
use Validator, DB, Hash, Mail;
use Tymon\JWTAuth\Exceptions\JWTException;

class CDCController extends Controller
{
    public function get_list() {
    	$list = [];
    	$cdc = ChronicDiseaseCategory::where('status', 1)
    	->where('parent_id', '!=',0)
    	->orderBy('priority', 'asc')->get();

    	foreach ($cdc as $key=>$row) {
    		$full_title = self::get_parent_title($row->parent_id) . ' => ' . $row->cd_title;
    		$list[$key]['id'] = $row->id;
    		$list[$key]['cd_title'] = $full_title;
    		$list[$key]['parent_id'] = $row->parent_id;
    	}

    	try {
    		return response()->json(['data'=> $list], 200);
    	} catch (JWTException $e) {
    		return response()->json(['error'=> 'failed to get list please try again!'], 500);
    	}
    	
    }

    private static function get_parent_title($update_id) {
    	return ChronicDiseaseCategory::find($update_id)->cd_title;
    }

    public function add_cd_title(Request $request) {
    	$validator = Validator::make($request->all(), [
    		'cd_title'=> 'required|string|min:3|max:191|unique:chronic_disease_categories,cd_title',
    		'parent_id'=> 'numeric'
    	]);	

    	if($validator->fails())
    		return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

    	try {
    		$cdc = new ChronicDiseaseCategory();
    		$cdc->cd_title = $request->cd_title;
    		$cdc->status = 0;
    		$cdc->parent_id = $request->parent_id;
    		$cdc->save();

    		return response()->json(['success'=> true, 'data'=> $cdc->id], 200);
    	} catch (JWTException $e) {
    		return response()->json(['success'=> false, 'error'=> 'failed to add Chronic Disease Title please try again!'], 500);
    	}
    }
}
