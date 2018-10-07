<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ChronicDrugList;
use App\ChronicDrugs;
use Validator, Session, File, Image;
use App\Traits\UserSummary AS UserSummaryTrait; 

class ChronicDrugsController extends Controller
{
     use UserSummaryTrait;

    public function get_list() {
    	$list = [];
    	$cdc = ChronicDrugList::where('status', 1)
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


    public function add_lab_title(Request $request) {
    	$validator = Validator::make($request->all(), [
    		'title'=> 'required|string|min:3|max:191|unique:labs,title',
    	]);	

    	if($validator->fails())
    		return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

    	try {
    		$cdc = new ChronicDrugList();
    		$cdc->title = $request->title;
    		$cdc->status = 0;
    		$cdc->save();

    		return response()->json(['success'=> true, 'data'=> $cdc->id], 200);
    	} catch (JWTException $e) {
    		return response()->json(['success'=> false, 'error'=> 'failed to add Drug Chronic Drugs Title please try again!'], 500);
    	}
    }


    //Added Data


    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'drug_id'=> 'required|numeric',
            'dose'=> 'required',
            'till_now'=> 'required',
            'user_id'=> 'required|numeric'
        ]);

        if($validator->fails())
            return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

        try {
            $drug = new ChronicDrugs();
            $drug->drug_id = $request->drug_id;
            $drug->dose = $request->dose;
            $drug->till_now = $request->till_now;
            $drug->will_stop = $request->will_stop;
            $drug->user_id = $request->user_id;
            $drug->save();

            $this->updateChronicDrugs($drug->user_id, 1); //define in trait

            return response()->json(['success'=> true, 'message'=> 'Successfully Chronic Drug  has been added!'], 200);
        } catch (JWTException $e) {
            return response()->json(['success'=> false, 'error'=> 'failed to add Chronic Drug  please try again!'], 500);
        }
    }



    public function update(Request $request, $update_id) {
        $validator = Validator::make($request->all(), [
            'drug_id'=> 'required|numeric',
            'dose'=> 'required',
            'till_now'=> 'required',
           
        ]);

        if($validator->fails())
            return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

        try {
            $drug = ChronicDrugs::findOrFail($update_id);
            $drug->drug_id = $request->drug_id;
            $drug->dose = $request->dose;
            $drug->till_now = $request->till_now;
            $drug->will_stop = $request->will_stop;
            $drug->save();

           

            return response()->json(['success'=> true, 'message'=> 'Successfully Chronic Drug  has been updated!'], 200);
        } catch (JWTException $e) {
            return response()->json(['success'=> false, 'error'=> 'failed to update Chronic Drug  please try again!'], 500);
        }
    }

    private static function get_user_id($drug_id) {
        return ChronicDrugs::find($drug_id)->user_id;
    }

    public function delete_item(Request $request) {
        $validator = Validator::make($request->all(), [
            'id'=> 'required|numeric',
        ]);

        if($validator->fails())
            return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

        $this->updateChronicDrugs(self::get_user_id($request->id), 0); //define in trait
       
        $drug = ChronicDrugs::findOrFail($request->id);
        $drug->delete();

        return response()->json(['success'=> true, 'message'=> 'Successfully Chronic Drug has been deleted!'], 200);
    }
}
