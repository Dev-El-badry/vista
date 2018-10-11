<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PublicUser;
use Validator, Session, File;

class PublicUserController extends Controller
{
    public function index() {
    	$pu = PublicUser::orderBy('id', 'desc')->get();
    	return view('manage.public_users.index')->withPu($pu);
    }

    public function view($update_id) {
    	$user = PublicUser::where('id', $update_id)->with('user_job')->first();
    	
    	return view('manage.public_users.view')->withUser($user);
    }

    public function update_status(Request $request, $id) {
    	$pu = PublicUser::findOrFail($id);
    	$pu->is_verified = $request->is_verified;
    	$pu->save();

    	Session::flash('item', 'Successfully Update Status Of User');
    	return redirect()->back();
    }

    public function delete_config($update_id) {
    	return view('manage.public_users.delete_config', compact('update_id'));
    }

    public function destroy(Request $request, $update_id) {

    	if($request->submit == 'Finished')
    		return redirect()->route('public_users.index');

    	$this->delete_process($update_id);

    	$uj = PublicUser::findOrFail($update_id);
    	$uj->delete();

    	Session::flash('item_del', 'Successfully User has been deleted!');
    	return redirect()->route('public_users.index');
    }

    private function delete_process($update_id) {
    	$pu = PublicUser::findOrFail($update_id);
    	$files = $pu->picture;

    	
    		$pic_path = public_path('manage/img/user_pics/').$files;
    		if(file_exists($pic_path)){
    			File::delete($pic_path);
    		}
    	
    }
}
