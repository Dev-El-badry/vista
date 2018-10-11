<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserJob;
use DB, Validator;
use App\CompliantForm;
class ChatController extends Controller
{
    public function chat_request(Request $request) {
    	$me_id = $request->me_id;
    	$target_id = $request->target_id;

    	$check = $this->chk_if_same_job($me_id, $target_id);
    	if($check == TRUE) {
    		//Open Chat
    	} else {
    		//do some procedures to make chat
    		$this->request_chat($me_id, $target_id);
    	}

    }

    private function chk_if_same_job($me_id, $target_id) {

    	$target_job = UserJob::where('user_id', $target_id)->first()->job_id;
    	$me_job = UserJob::where('user_id', $me_id)->where('confirm', 1)->where('job_id', $target_job)->count();

    	if($me_job > 0)
    		return TRUE;
    	else
    		return FALSE;
    }

    public function request_chat($me_id, $target_id) {
    	//first: complaint form

    	//second wating response
    }

    public function submit_form(Request $request) {

        $validator = Validator::make($request->all(), [
            'user_id'=> 'required|numeric',
            'compliant_title_id'=> 'required|numeric',
            'started_at'=> 'required|date'
        ]); 

        if($validator->fails())
            return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

    	$user_id = $request->user_id;

        $cf = new CompliantForm();
        $cf->user_id = $user_id,
        $cf->compliant_title_id = $request->compliant_title_id,
        $cf->started_at = $request->started_at
        $cf->save();

        //Xray

        //NOTE: must send xray equal value 1
        if($request->xray) {
            $query_xray = DB::table('compliant_xray')->insert([
                'report'=> $request->report,
                'date_mode'=> $request->date_mode,
                'compliant_id' => $cf->id
            ]);

            $this->do_upload_xray($request->xray_picture,  $query_xray->id);

        }

        //Recent Drugs

        //Note: must send recent drugs equal value 1
        if($request->recent_drugs) {
            DB::table('compliant_recent_drugs')->insert([
                'drug_id'=> $request->drug_id,
                'dose'=> $request->dose,
                'compliant_id' => $cf->compliant_id
            ]);
        }

        //Compliant Other

        //Note: must send other equal value 1
        if($request->others) {
            $query_others = DB::table('compliant_others')->insert([
                'content'=> $request->content,
                'compliant_id' => $cf->compliant_id
            ]);

            $this->do_upload_xray($request->other_picture,  $query_others->id);
        }

        //Compliant medical report

        //NOTE: must send medical report equal 1
        if($request->medical_report) {
            $query_medical = DB::table('compliant_medical_report')->insert([
                'compliant_id' => $cf->compliant_id
            ]);

            $this->do_upload_medical($request->medical_picture, $query_medical->id);
        }

        //Complaint Labs

        //NOTE: must labs report equal 1
        if($request->labs) {
            $query_lab = DB::table('compliant_labs')->insert([
                'picture'=> $request->picture, //upload picture
                'lab_id' => $request->lab_id,
                'date_mode' => $request->date_mode,
                'compliant_id' => $cf->compliant_id,
            ]);

            $this->do_upload_lab($request->lab_picture, $query_lab->id);
        }
    }

    //xray
    public function do_upload_xray($image, $xray_id)
    {

        $input['image'] = time(). '-' .str_random(6) .'.'.$image->getClientOriginalExtension();
        $dist = public_path('/manage/img/xray_pics/');
        
        $image->move($dist, $input['image']);
        
        $pu = DB::table('compliant_xray')->where('id', $xray_id)->update([
            'xray_picture'=> $input['image']
        ]);
       
    }

    //Compliant Others
    public function do_upload_other($image, $other_id)
    {

        $input['image'] = time(). '-' .str_random(6) .'.'.$image->getClientOriginalExtension();
        $dist = public_path('/manage/img/other_pics/');
        
        $image->move($dist, $input['image']);
        
         $pu = DB::table('compliant_others')->where('id', $other_id)->update([
            'other_picture'=> $input['image']
        ]);

    }

    //Compliant Medical
    public function do_upload_medical($image, $medical_id)
    {

        $input['image'] = time(). '-' .str_random(6) .'.'.$image->getClientOriginalExtension();
        $dist = public_path('/manage/img/medical_pics/');
        
        $image->move($dist, $input['image']);
        
         $pu = DB::table('compliant_medical_report')->where('id', $medical_id)->update([
            'medical_picture'=> $input['image']
        ]);

    }

    //Compliant Medical
    public function do_upload_lab($image, $lab_id)
    {

        $input['image'] = time(). '-' .str_random(6) .'.'.$image->getClientOriginalExtension();
        $dist = public_path('/manage/img/lab_pics/');
        
        $image->move($dist, $input['image']);
        
         $pu = DB::table('compliant_labs')->where('id', $medical_id)->update([
            'lab_picture'=> $input['image']
        ]);

    }

}
