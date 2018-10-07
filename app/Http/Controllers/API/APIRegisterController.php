<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PublicUser;
use JWTFactory;
use JWTAuth;
use Validator, DB, Hash, Mail;
use App\Traits\UserSummary AS UserSummaryTrait; 

class APIRegisterController extends Controller
{
    use UserSummaryTrait;

    public function register(Request $request) {
    	$credentials = $request->only('name', 'email', 'password', 'telnum', 'login_social', 'social_account_title');
    	//Note: if not register from third party login login_social: value is zero and social_account_title is null
    	$rules = [
    		'name' => 'required|max:255|unique:public_users',
    		'email' => 'required|email|max:255|unique:public_users',
            'phone_number'=> 'sometimes|nullable|string|min:10|unique:public_users'
            'group_id'=> 'required|numeric'
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
    	$user->login_social = $request->login_social;
        $user->social_account_title = $request->social_account_title;
    	$user->group_id = $request->group_id; //Note: 0 OR 1
    	$user->save();
    	$code = strtolower(str_random(6));
    	DB::table('user_verification')->insert(
    		['user_id'=>$user->id, 'verification_code'=>$code]
    	);
    	$email = $user->email;
    	$name = $user->name;
    	$subject = 'Please Verifiy Your Account';
    	Mail::send('public_users.auth.verify', ['name'=>$user->name, 'code'=> $code], function($mail) use ($email,$name, $subject) {
    		//$mail->from(getenv('FROM_EMAIL_ADDRESS'), 'From User/Company Name Goes Here');
    		$mail->to($email, $name);
    		$mail->subject($subject);
    	});
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

            $this->create_profile($check->user_id);

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
