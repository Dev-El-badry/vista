<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserJob;
use DB, Validator;
use App\CompliantForm;
use App\RequestChat;
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

    public function submit_form(Request $request, $user_id, $bm_id) {
        //Don't forget cost in request
        $validator = Validator::make($request->all(), [
          
            'compliant_title_id'=> 'required|numeric',
            'started_at'=> 'required|date'
        ]); 

        if($validator->fails())
            return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

    	// $user_id = $request->user_id;

        $cf = new CompliantForm();
        $cf->user_id = $user_id;
        $cf->compliant_title_id = $request->compliant_title_id;
        $cf->started_at = $request->started_at;
        $cf->save();

        $com_id = $cf->id;

        //Xray

        //NOTE: must send xray equal value 1
        if($request->xray) {
            DB::table('compliant_xray')->insert([
                'report'=> $request->report,
                'date_mode_xray'=> $request->date_mode_xray,
                'compliant_id' => $cf->id
            ]);

            $max_id_xray = DB::table('compliant_xray')->max('id');

            
            $this->do_upload_xray($request->xray_picture,  $max_id_xray);

        }

        //Recent Drugs

        //Note: must send recent drugs equal value 1
        if($request->recent_drugs) {
            DB::table('compliant_recent_drugs')->insert([
                'drug_id'=> $request->drug_id,
                'dose'=> $request->dose,
                'compliant_id' => $com_id
            ]);
        }

        //Compliant Other

        //Note: must send other equal value 1
        if($request->others) {
            DB::table('compliant_others')->insert([
                'content'=> $request->content,
                'compliant_id' => $com_id
            ]);

            $max_id_other = DB::table('compliant_others')->max('id');

            $this->do_upload_other($request->other_picture,  $max_id_other);
        }

        //Compliant medical report

        //NOTE: must send medical report equal 1
        if($request->medical_report) {
            DB::table('compliant_medical_report')->insert([
                'compliant_id' => $com_id
            ]);

            $max_id_report = DB::table('compliant_medical_report')->max('id');

            $this->do_upload_medical($request->medical_picture, $max_id_report);
        }

        //Complaint Labs

        //NOTE: must labs report equal 1
        if($request->labs) {
            DB::table('compliant_labs')->insert([
                
                'lab_id' => $request->lab_id,
                'date_mode_lab' => $request->date_mode_lab,
                'compliant_id' => $com_id,
            ]);

            $max_id_lab = DB::table('compliant_labs')->max('id');

            $this->do_upload_lab($request->lab_picture, $max_id_lab);
        }

        //After All Make Request Chats
        $this->create_request($com_id, $user_id, $bm_id, $request->cost); //defined below

        //update visit in business model
        $this->increase_count_visit_running($bm_id);

        return response()->json(['success'=> true, 'message'=> 'Successfully request now go to pay this call with doctor!', 'cost'=> $request->cost], 200);
    }

    public function increase_count_visit_running($update_id) {
        $vista_wateing = DB::table('business_model')->where('id', '=',$update_id)->first()->vista_wateing;
        $vista_wateing = $vista_wateing + 1;
        DB::table('business_model')->where('id', $update_id)->update(['vista_running'=> $vista_wateing  ]);
    }

    public function create_request($com_id, $user_id, $bm_id, $cost = 0) {
        $rc = new RequestChat();
        $rc->bm_name = $this->get_user_name($bm_id);
        $rc->user_name = $this->get_user_name($user_id);
        $rc->bm_id = $bm_id;
        $rc->user_id = $user_id;
        $rc->compliant_id = $com_id;
        $rc->ref_num = str_random(6);
        $rc->dr_approve = 0;
        $rc->cost = $cost;
        $rc->save();

    }

    private function get_user_name($update_id) {
        return DB::table('public_users')->where('id', $update_id)->first()->name;
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
        
         $pu = DB::table('compliant_labs')->where('id', $lab_id)->update([
            'lab_picture'=> $input['image']
        ]);

    }

}
