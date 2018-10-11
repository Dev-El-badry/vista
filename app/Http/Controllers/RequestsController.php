<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserJob;
use App\RequestOption;
use App\BusinessModel;
use VAlidator, DB, Session, File, Image;
use App\Traits\SendMail;
class RequestsController extends Controller
{
	use SendMail;
    public function index() {
    	$requests = UserJob::where('files', '!=', null)->with('user', 'job', 'option')->orderBy('created_at', 'desc')->get();
    	
    	return view('manage.requests.index')->withRequests($requests);
    }

    public function view($update_id) {
    	$this->set_it_opened($update_id);
    	$request = UserJob::where('id', $update_id)->with('user', 'job')->first();
    	$options = $this->get_list();
    	return view('manage.requests.view')->withRequest($request)->withOptions($options);
    }

    private function set_it_opened($update_id) {
    	$uj = UserJob::where('id', $update_id)->first();
    	$uj->opened = 1;
    	$uj->save();
    }

    private function get_list() {
    	$reqs = RequestOption::all();
    	$option[0] = 'Submitted';
    	foreach ($reqs as $row) {
    		$option[$row->id] = $row->title;
    	}

    	return $option;
    }

    public function update_option(Request $request, $update_id) {
    	$option = UserJob::findOrFail($update_id);
    	$option->option_id = $request->option_id;
    	$option->save();

    	/* Send Email */
        $data['file_path'] = 'manage.requests.update_option';
        $data['data'] = [
            'option'=> RequestOption::find($request->option_id)->title,
            'name'=>$option->user->name
        ];
        $data['email'] = $option->user->email;
        $data['name'] = $option->user->name;

        $data['subject'] = 'Doucmenting Job';

        $this->sendMail($data);
        /* Send Email */

    	Session::flash('item', 'Successfully Option Has Been Updated!');
    	return redirect()->back();
    }

    public function update_status(Request $request, $update_id) {
    	$option = UserJob::findOrFail($update_id);
    	$option->confirm = $request->confirm;
    	$option->save();

    	if($option->confirm == 1) {
    		//Create Businesss Model
    		$this->create_business_model_for_user($option->user_id);
    	}

    	/* Send Email */
        $data['file_path'] = 'manage.requests.update_status';
        $data['data'] = [
            'confirm'=> $request->confirm,
            'name'=>$option->user->name
        ];
        $data['email'] = $option->user->email;
        $data['name'] = $option->user->name;

        $data['subject'] = 'Doucmenting Job';

        $this->sendMail($data);
        /* Send Email */

    	Session::flash('item', 'Successfully Request Status Has Been Updated!');
    	return redirect()->back();
    }

    private function create_business_model_for_user($user_id) {
    	$bufu = new BusinessModel();
    	$bufu->user_id = $user_id;
    	$bufu->save();
    }

    public function delete_config($update_id) {
    	return view('manage.requests.delete_config', compact('update_id'));
    }

    public function destroy(Request $request, $update_id) {
        if($request->submit == 'Finished')
            return redirect()->route('requests.index');

    	$this->delete_process($update_id);

    	$uj = UserJob::findOrFail($update_id);
    	$uj->delete();

    	Session::flash('item_del', 'Successfully Request has been deleted!');
    	return redirect()->route('requests.index');
    }

    private function delete_process($update_id) {
    	$uj = UserJob::findOrFail($update_id);
    	$files = explode(',', $uj->files);

    	for ($i=0; $i < count($files); $i++) { 
    		$pic_path = public_path('manage/img/identity_pics/').$files[$i];
    		if(file_exists($pic_path)){
    			File::delete($pic_path);
    		}
    	}
    }
}
