<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PublicUser;
use Validator, DB, File, Image;


class UserController extends Controller
{
    public function update_profile(Request $request, $update_id) {
    	$validator = Validator::make($request->all(), [
    		'name'=> 'required|string|min:3|max:191|unique:public_users,name,'.$update_id,
    		'sex'=> 'required', // male - female
    		'age'=> 'sometimes|nullable',
    		'country'=> 'sometimes|nullable|max:80|min:3',
    		'state'=> 'sometimes|nullable|max:80|min:3',
    		'address1'=> 'sometimes|nullable|max:120|min:3',
    		'telnum'=> 'required|max:191',
    		'picture'=> 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    	]);	

    	if($validator->fails())
    		return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

    	try {
	    	$pu = PublicUser::findOrFail($update_id);
	    	$pu->name =  $request->name;
	    	$pu->sex =  $request->sex;
	    	$pu->age =  $request->age;
	    	$pu->country =  $request->country;
	    	$pu->state =  $request->state;
	    	$pu->address1 =  $request->address1;
	    	$pu->address2 =  $request->address2;
	    	$pu->telnum =  $request->telnum;
	    	$pu->job_title_id =  $request->job_title_id;

	    	$pu->save();

	    	if($request->hasFile('image')) {
	    		$this->delete_process($update_id);
	    		$this->do_upload($request->image, $update_id);
	    	}

	    	return response()->json(['success'=> true, 'message'=> 'Successfully User Profile has been Updated!'], 200);
    	} catch (JWTException $e) {
    		return response()->json(['success'=> false, 'error'=> 'failed to update User Profile please try again!'], 500);
    	}


    }


    public function do_upload($image, $prof_id)
    {

        $input['image'] = time().'.'.$image->getClientOriginalExtension();
        $dist = public_path('/manage/img/user_pics');
        
        $image->move($dist, $input['image']);
        
        $pu = PublicUser::findOrFail($prof_id);
        $pu->picture = $input['image'];
        $pu->save();

    }

    public function delete_picture($user_id) {

    	if(!is_numeric($user_id)) {
    		return response()->json(['success'=> false, 'message'=> 'must user id is numeric value .. please try again!'], 401);
    	}

    	try {
	    	
			$this->delete_process($user_id);

			$pu = PublicUser::findOrFail($user_id);
			$pu->picture = null;
			$pu->save();

	    	return response()->json(['success'=> true, 'message'=> 'Successfully Delete Picture!'], 200);
    	} catch (JWTException $e) {
    		return response()->json(['success'=> false, 'error'=> 'failed to Delete Picture please try again!'], 500);
    	}
    	
    }

    private function delete_process($user_id)
    {
    	$pu = PublicUser::findOrFail($user_id);
        $user_image = public_path('manage/img/user_pics/').$pu->picture;
       
        if(file_exists($user_image)) 
        {
            
            File::delete($user_image);
        }
    }
}
