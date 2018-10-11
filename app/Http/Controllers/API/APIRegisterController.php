<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PublicUser;
use JWTFactory;
use JWTAuth;
use Validator, DB, Hash, Mail;
use App\Traits\UserSummary AS UserSummaryTrait; 
use App\Traits\SendMail; 

class APIRegisterController extends Controller
{
    use UserSummaryTrait, SendMail;

    public function register(Request $request) {
    	$credentials = $request->only('name', 'email', 'password', 'telnum', 'login_social', 'social_account_title');
    	//Note: if not register from third party login login_social: value is zero and social_account_title is null
    	$rules = [
    		'name' => 'required|max:255|unique:public_users',
    		'email' => 'required|email|max:255|unique:public_users',
            'telnum'=> 'sometimes|nullable|string|min:10|unique:public_users',
            'sex'=> 'required'
    	];


    	$validator = Validator::make($credentials, $rules);
    	if($validator->fails())
    	{
    		return response()->json(['success'=>false, 'errors'=> $validator->errors() ], 401);
    	}
    	$user = new PublicUser();
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = Hash::make($request->password);
        $user->telnum = $request->telnum;
    	$user->sex = $request->sex;
    	$user->login_social = $request->login_social;// TRUE OR FALSE
        $user->social_account_title = $request->social_account_title;
    	$user->save();
    	$code = strtolower(str_random(6));
    	DB::table('user_verification')->insert(
    		['user_id'=>$user->id, 'verification_code'=>$code]
    	);

        /* Send Email */
        $data['file_path'] = 'public_users.auth.verify';
        $data['data'] = [
            'name'=> $user->name,
            'code'=> $code
        ];
        $data['email'] = $user->email;
        $data['name'] = $user->name;
        $data['subject'] = 'Please Verifiy Your Account';

        $this->sendMail($data);
        /* Send Email */

    	return response()->json(['success'=>true, 'message'=>'Thanks For Signing Up! Please Check Your Email To Complete Your Register'], 200);
    }

    public function verifyUser(Request $request)
    {
    	$verification_code = strtolower($request->code);

    	if(is_null($request->code)) {
    		return response()->json(['success'=>false, 'errors'=> 'code verification is required value' ], 401);
    	}

    	$check = DB::table('user_verification')
    			->where('verification_code', $verification_code)
    			->first();
    	if(!is_null($check))
    	{
    		$user = PublicUser::find($check->user_id);
    		if($user->is_verified == 1)
    		{
    			return response()->json(['success'=> true, 'message'=> 'Account Aready Verified']);
    		}
    		$user->is_verified = 1;
    		$user->save();

            //$this->create_profile($check->user_id);

    		DB::table('user_verification')->where('verification_code', $verification_code)->delete();
    		return response()->json([
    			'success'=> true,
    			'message'=> 'You have successfully verified your email address'
    		]);
    	} else {
    		return response()->json(['success'=>false, 'errors'=> 'code verification is wrong. try again' ], 404);
    	}
    }
}
