<?php

namespace App\Http\Controllers;
use App\NotifyAdmin;
use DB;
class ManageController extends Controller
{

    public static function get_notify_admin() {
    	//NOTE: first version of notification
    	$notifications = NotifyAdmin::where('opened', 0)->with('job', 'user')->orderBy('created_at')->get();
    	return $notifications;
    }
}
	