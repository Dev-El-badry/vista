<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lab;
use App\StoreLab;
use Validator, Session, File, Image;
use App\Traits\UserSummary AS UserSummaryTrait; 
class LabController extends Controller
{
    use UserSummaryTrait;

    public function get_list() {
    	$list = [];
    	$cdc = Lab::where('status', 1)
    	->orderBy('priority', 'asc')->get();

    	foreach ($cdc as $key=>$row) {
    		$list[$key]['id'] = $row->id;
    		$list[$key]['title'] = $row->title;
    	}

    	try {
    		return response()->json(['data'=> $list], 200);
    	} catch (JWTException $e) {
    		return response()->json(['error'=> 'failed to get list please try again!'], 500);
    	}
    	
    }


    public function add_lab_title(Request $request) {
    	$validator = Validator::make($request->all(), [
    		'title'=> 'required|string|min:3|max:191|unique:labs,title',
    	]);	

    	if($validator->fails())
    		return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

    	try {
    		$cdc = new Lab();
    		$cdc->title = $request->title;
    		$cdc->status = 0;
    		$cdc->save();

    		return response()->json(['success'=> true, 'message'=> 'Successfully Lab Title has been added!'], 200);
    	} catch (JWTException $e) {
    		return response()->json(['success'=> false, 'error'=> 'failed to add Lab Title please try again!'], 500);
    	}
    }


    //Added Data


    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'lab_id'=> 'required|numeric',
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date_mode'=> 'required|date',
            'user_id'=> 'required|numeric'
        ]);

        if($validator->fails())
            return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

        try {
            $lab = new StoreLab();
            $lab->lab_id = $request->lab_id;
            $lab->value = $request->value;
            $lab->date_mode = $request->date_mode;
            $lab->user_id = $request->user_id;
            $lab->save();
            $this->do_upload($request->image, $lab->id);

            $this->update_lab($lab->user_id, 1); //define in trait

            return response()->json(['success'=> true, 'message'=> 'Successfully Lab Report has been added!'], 200);
        } catch (JWTException $e) {
            return response()->json(['success'=> false, 'error'=> 'failed to add Lab Report please try again!'], 500);
        }
    }

    public function do_upload($image, $lab_id)
    {

        $input['image'] = time().'.'.$image->getClientOriginalExtension();
        $dist = public_path('/manage/img/lab_pics/');
        
        $image->move($dist, $input['image']);
        
        $pu = StoreLab::findOrFail($lab_id);
        $pu->picture = $input['image'];
        $pu->save();

    }

    public function update(Request $request, $update_id) {
        $validator = Validator::make($request->all(), [
            'lab_id'=> 'required|numeric',
            'picture'=> 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date_mode'=> 'required|date'
        ]);

        if($validator->fails())
            return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

        try {
            $lab = StoreLab::findOrFail($update_id);
            $lab->lab_id = $request->lab_id;
            $lab->value = $request->value;
            $lab->date_mode = $request->date_mode;
            $lab->save();

            if($request->hasFile('image')){
                $this->delete_process($update_id);
                $lab = StoreLab::findOrFail($update_id);
                $this->do_upload($request->image, $update_id);
            }

            return response()->json(['success'=> true, 'message'=> 'Successfully Lab Report has been updated!'], 200);
        } catch (JWTException $e) {
            return response()->json(['success'=> false, 'error'=> 'failed to update Lab Report please try again!'], 500);
        }
    }

    private function delete_process($update_id)
    {
        $pu = StoreLab::findOrFail($update_id);
        $lab_pic = public_path('manage/img/lab_pics/').$pu->picture;
       
        if(file_exists($lab_pic)) 
        {
            
            File::delete($lab_pic);
        }
    }

    private static function get_user_id($lab_id) {
        return StoreLab::find($lab_id)->user_id;
    }

    public function delete_item(Request $request) {
        $validator = Validator::make($request->all(), [
            'id'=> 'required|numeric',
        ]);

        if($validator->fails())
            return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

        $this->update_lab(self::get_user_id($request->id), 0); //define in trait
        $this->delete_process($request->id);
        $lab = StoreLab::findOrFail($request->id);
        $lab->delete();

        return response()->json(['success'=> true, 'message'=> 'Successfully Lab Report has been deleted!'], 200);
    }
}
