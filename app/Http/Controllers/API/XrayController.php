<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\XrayReport;
use Validator, Session, File, Image;
use App\Traits\UserSummary AS UserSummaryTrait; 

class XrayController extends Controller
{
	use UserSummaryTrait;

    public function store(Request $request) {

    	$validator = Validator::make($request->all(), [
    		'report'=> 'required',
    		'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    		'date_mode'=> 'required|date',
    		'user_id'=> 'required|numeric'
    	]);

    	if($validator->fails())
    		return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

    	try {
    		$xray = new XrayReport();
    		$xray->report = $request->report;
    		$xray->date_mode = $request->date_mode;
    		$xray->user_id = $request->user_id;
    		$xray->save();
    		$this->do_upload($request->image, $xray->id);

    		$this->update_xray($xray->user_id, 1); //define in trait

    		return response()->json(['success'=> true, 'message'=> 'Successfully Xray Report has been added!'], 200);
    	} catch (JWTException $e) {
    		return response()->json(['success'=> false, 'error'=> 'failed to add Xray Report please try again!'], 500);
    	}
    }

    public function do_upload($image, $xray_id)
    {

        $input['image'] = time().'.'.$image->getClientOriginalExtension();
        $dist = public_path('/manage/img/xray_pics/');
        
        $image->move($dist, $input['image']);
        
        $pu = XrayReport::findOrFail($xray_id);
        $pu->picture = $input['image'];
        $pu->save();

    }

    public function update(Request $request, $update_id) {
    	$validator = Validator::make($request->all(), [
    		'report'=> 'required',
    		'picture'=> 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    		'date_mode'=> 'required|date'
    	]);

    	if($validator->fails())
    		return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

    	try {
    		$xray = XrayReport::findOrFail($update_id);
    		$xray->report = $request->report;
    		$xray->date_mode = $request->date_mode;
    		$xray->save();

    		if($request->hasFile('image')){
    			$this->delete_process($update_id);
	    		$xray = XrayReport::findOrFail($update_id);
    			$this->do_upload($request->image, $update_id);
    		}

    		return response()->json(['success'=> true, 'message'=> 'Successfully Xray Report has been updated!'], 200);
    	} catch (JWTException $e) {
    		return response()->json(['success'=> false, 'error'=> 'failed to update Xray Report please try again!'], 500);
    	}
    }

    private function delete_process($update_id)
    {
    	$pu = XrayReport::findOrFail($update_id);
        $xray_pic = public_path('manage/img/xray_pics/').$pu->picture;
       
        if(file_exists($xray_pic)) 
        {
            
            File::delete($xray_pic);
        }
    }

    public function delete_item(Request $request) {
    	$validator = Validator::make($request->all(), [
    		'id'=> 'required|numeric',
    	]);

    	if($validator->fails())
    		return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

    	$this->delete_process($request->id);
    	$xray = XrayReport::findOrFail($request->id);
    	$xray->delete();

    	return response()->json(['success'=> true, 'message'=> 'Successfully Xray Report has been deleted!'], 200);
    }


}
