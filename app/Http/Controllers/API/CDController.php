<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ChronicDisease;
use App\ChronicDiseaseCategory;
use JWTFactory;
use JWTAuth;
use Validator, DB, Hash, Mail;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Traits\UserSummary AS UserSummaryTrait; 
class CDController extends Controller
{
	use UserSummaryTrait;

    public function store(Request $request) {
    	$validator = Validator::make($request->all(), [
    		'name'=> 'required|min:3|max:191',
    		'cd_id'=> 'required|numeric',
    		'user_id'=> 'required|numeric',
    	]);

    	if($validator->fails())
    		return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

    	try {
    		$cdc = new ChronicDisease();
    		$cdc->cd_title = self::get_title_cdc_title($request->cd_id);
    		$cdc->name = $request->name;
    		$cdc->cd_id = $request->cd_id;
    		$cdc->user_id = $request->user_id;
    		$cdc->save();
    		$this->update_cd($cdc->user_id);

    		return response()->json(['success'=> true, 'message'=> 'Successfully Chronic Disease has been added!'], 200);
    	} catch (JWTException $e) {
    		return response()->json(['success'=> false, 'error'=> 'failed to add Chronic Disease please try again!'], 500);
    	}
    }

    private static function get_title_cdc_title($cd_id) {
    	return ChronicDiseaseCategory::find($cd_id)->cd_title;
    }
}
