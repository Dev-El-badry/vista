<?php

namespace App\Traits;
use Mail, DB;

trait SendMail {

    public function sendMail($data) {
    	/*

    	NOTE: 
    	$data = array(
			'file_path' => '',
			'data'=> array(),
			'email'=> '' ,
			'name'=> '',
			'subject'=> ''
    	);

    	*/

    	$email = $data['email'];
    	$name = $data['name'];
    	$subject = $data['subject'];

       Mail::send($data['file_path'], $data['data'], function($mail) use ($email,$name, $subject) {
    		//$mail->from(getenv('FROM_EMAIL_ADDRESS'), 'From User/Company Name Goes Here');
    		$mail->to($email, $name);
    		$mail->subject($subject);
    	});
    }

}
