<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ChronicDrugList;
use App\RecentDrug;
use Validator, Session, File, Image;
use App\Traits\UserSummary AS UserSummaryTrait; 

class RecentDrugsController extends Controller
{
     use UserSummaryTrait;


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
            $drug = new RecentDrug();
            $drug->drug_id = $request->drug_id;
            $drug->dose = $request->dose;
            $drug->till_now = $request->till_now;
            $drug->will_stop = $request->will_stop;
            $drug->user_id = $request->user_id;
            $drug->save();

            $this->updateRecentDrug($drug->user_id, 1); //define in trait

            return response()->json(['success'=> true, 'message'=> 'Successfully Recent Drug  has been added!'], 200);
        } catch (JWTException $e) {
            return response()->json(['success'=> false, 'error'=> 'failed to add Recent Drug  please try again!'], 500);
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
            $drug = RecentDrug::findOrFail($update_id);
            $drug->drug_id = $request->drug_id;
            $drug->dose = $request->dose;
            $drug->till_now = $request->till_now;
            $drug->will_stop = $request->will_stop;
            $drug->save();

           

            return response()->json(['success'=> true, 'message'=> 'Successfully Recent Drug  has been updated!'], 200);
        } catch (JWTException $e) {
            return response()->json(['success'=> false, 'error'=> 'failed to update Recent Drug  please try again!'], 500);
        }
    }

    private static function get_user_id($drug_id) {
        return RecentDrug::find($drug_id)->user_id;
    }

    public function delete_item(Request $request) {
        $validator = Validator::make($request->all(), [
            'id'=> 'required|numeric',
        ]);

        if($validator->fails())
            return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

        $this->updateRecentDrug(self::get_user_id($request->id), 0); //define in trait
       
        $drug = RecentDrug::findOrFail($request->id);
        $drug->delete();

        return response()->json(['success'=> true, 'message'=> 'Successfully Recent Drug has been deleted!'], 200);
    }
}
