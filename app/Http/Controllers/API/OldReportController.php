<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\OldReport;
use Validator, Session, File, Image;
use App\Traits\UserSummary AS UserSummaryTrait; 

class OldReportController extends Controller
{
     use UserSummaryTrait;


    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id'=> 'required|numeric'
        ]);

        if($validator->fails())
            return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

        try {
            $image = $request->image;
            $input['image'] = time().'.'.$image->getClientOriginalExtension();
            $dist = public_path('/manage/img/old_reports_pics/');
            
            $image->move($dist, $input['image']);
            
            $or = new OldReport();
            $or->picture = $input['image'];
            $or->user_id = $request->user_id;
            $or->save();

            $this->updateOldReport($or->user_id, 1); //define in trait

            return response()->json(['success'=> true, 'message'=> 'Successfully Old Report  has been added!'], 200);
        } catch (JWTException $e) {
            return response()->json(['success'=> false, 'error'=> 'failed to add Old Report  please try again!'], 500);
        }
    }


    private static function get_user_id($or) {
        return OldReport::find($or)->user_id;
    }

    public function delete_item(Request $request) {
        $validator = Validator::make($request->all(), [
            'id'=> 'required|numeric',
        ]);

        if($validator->fails())
            return response()->json(['success'=> false, 'erorrs'=> $validator->errors()], 401);

        $count = OldReport::count();

        if($count == 1)
            $this->updateOldReport(self::get_user_id($request->id), 0); //define in trait

        $this->delete_process($request->id);
       
        $or = OldReport::findOrFail($request->id);
        $or->delete();

        return response()->json(['success'=> true, 'message'=> 'Successfully Old Report has been deleted!'], 200);
    }

    private function delete_process($update_id)
    {
        $pu = OldReport::findOrFail($update_id);
        $report_pic = public_path('manage/img/old_reports_pics/').$pu->picture;
       
        if(file_exists($report_pic)) 
        {
            File::delete($report_pic);
        }
    }
}
