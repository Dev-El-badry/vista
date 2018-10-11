<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserJob;
use App\PublicUser;
use Validator, DB, Mail;
use Tymon\JWTAuth\Exceptions\JWTException;
class JobIdentityController extends Controller
{
    public function index($user_id) {
    	if(is_numeric($user_id)) {

    		$jobs = UserJob::where('user_id', '=', $user_id)->with('job')->get();
           
    		if(count($jobs) <1) {
    			return response()->json(['success'=> false,'error'=> 'not found records in database'], 404);
    		}

    		foreach ($jobs as $key => $value) {
    			$data[$key]['id'] = $value->job->id;
    			$data[$key]['title'] = $value->job->title;
    			$data[$key]['status'] = $value->job->status;
    			$data[$key]['priority'] = $value->job->priority;
    			$data[$key]['check'] = $this->ck_job_is_identity($user_id, $value->job->id); 
    		}

    		try {
    			return response()->json(['success'=> true, 'data'=> $data], 200);
	    	} catch (JWTException $e) {
	    		return response()->json(['success'=> false, 'error'=> 'failed to job list please try again!'], 500);
	    	}

    	} else {
    		return response()->json(['success'=> false, 'error'=> 'not allowed to be here!'], 404);
    	}
    }

    private function ck_job_is_identity($user_id, $job_id) {
    	//NOTE: to check if is upload file for it so mark it is checked

    	$check = UserJob::where('user_id', '=', $user_id)->where('job_id','=', $job_id)->first();
        
    	if(($check->confirm > 0) OR ($check->files != null))
    		return 'true';
    	else
    		return 'false'; 
    }

    public function store(Request $request, $user_id) {
    	if(is_numeric($user_id)) {

    		$validator = Validator::make($request->all(), [
    			'job_id' => 'numeric',
    			'file.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    		]);

    		if($validator->fails())
    			return response()->json(['success'=> false, 'error'=> $validator->errors()], 401);

    		try {

				$files = $request->file;
                $files_path = '';

                for ($i=0; $i < count($files); $i++) { 
                    $image = $files[$i];
                    $input['image'] = time(). '-' . str_random(6) .'.'.$image->getClientOriginalExtension();
                    $dist = public_path('/manage/img/identity_pics/');
                    
                    $image->move($dist, $input['image']);

                    if($files_path == '')
                        $files_path = $input['image'];
                    else
                        $files_path .= ','.$input['image'];
                }

	    		$job = UserJob::where('user_id', '=', $user_id)->where('job_id', '=', $request->job_id)->first();
                $job->files = $files_path;
                $job->option_id = 0;
	    		$job->save();

	    		DB::table('notify_admin')->insert([
	    			'count_files'=> count($files),
	    			'job_id'=> $request->job_id,
	    			'user_id'=> $user_id,
	    		]);

	    		return response()->json(['success'=> true, 'message'=> 'Successfully Identity Job has been added!'], 200);
	    	} catch (JWTException $e) {
	    		return response()->json(['success'=> false, 'error'=> 'failed to add Identity Job please try again!'], 500);
	    	}

    	} else {
    		return response()->json(['success'=> false, 'error'=> 'not allowed to be here!'], 404);
    	}
    }

}
