<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Validator;
use App\CompliantTitle;
use Input;
class CompliantTitleController extends ManageController
{

    public function active_request(Request $request) {
        $id = $request->id;
        if(is_numeric($id)) {
            $cdc = CompliantTitle::findOrFail($id);
            $cdc->status = 1;
            $cdc->save();

            return 1;
        }

        return 0;
    }

    public function delete_request(Request $request) {
        $id = $request->id;
        if(is_numeric($id)) {
            $cdc = CompliantTitle::findOrFail($id);
            $cdc->delete();

            return 1;
        }

        return 0;
    }

    public function get_requests() {
        $requests = CompliantTitle::where("status", '=', '0')->paginate(15);
        return view('manage.compliant_title.get_requests')->withRequests($requests);
    }

 


    private function get_dropdown_categories()
    {
        $options[0] = 'Please Select compliant Title';
        $cdcs = CompliantTitle::get();
        foreach ($cdcs as $row) {
            $str = '';
           
                $str .= $row->title ;
           
            $options[$row->id] = $str;

        }

        return $options;
    }

    public function sort(Request $request)
    {
        $number = (int)$request->num;
        $order = $request->order;
        $arrs = explode(',', $order);

        for ($i=0; $i < count($arrs) ; $i++) { 
            $update_id = $arrs[$i];
            $cdc= CompliantTitle::findOrFail($update_id);
            $cdc->priority = $i+1;
            $cdc->save();
        }
      
    }



    public static function get_sortable_list( $status) {

        $status_val = Input::get('status');
        if(!isset($status_val))
            $status_val = 1;

        $data['categories'] = CompliantTitle::where('status', '=', 1)
                                    ->orderBy('priority', 'asc')
                                    ->get();

        $data['this_site'] = TRUE;

        return view('manage.compliant_title.sort_list', compact('data', 'status'))->render();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $status = null)
    {
       
        $data['row_id'] = $request->id;

        if(!is_numeric($data['row_id']))
        {
            $data['row_id'] = 0;
        }
        $data['status'] = $status;

        return view('manage.compliant_title.index')->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['options'] = $this->get_dropdown_categories();
        return view('manage.compliant_title.create')->withData($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->submit == 'Cancel')
        {
            return redirect()->route('compliant_title.index');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:compliant_titles,title',
        ]);

        if($validator->fails())
        {
            return redirect()->route('compliant_title.create')->withErrors($validator);
        }

        $cdc = new CompliantTitle();
        $cdc->title = $request->title;
        $cdc->status = 1;
        $cdc->save();

        Session::flash('item', 'Successfully Added Compliant !');

        return redirect()->route('compliant_title.edit', $cdc->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cdc = CompliantTitle::findOrFail($id);
        $data['options'] = $this->get_dropdown_categories();
        return view('manage.compliant_title.edit')->withCdc($cdc)->withData($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
        if($request->submit == 'Cancel')
        {
            
            return redirect()->route('compliant_title.index');
        }

        $validator = Validator::make($request->all(), [
            'title' =>  'required|unique:compliant_titles,title,'.$id,
           
        ]);


        if($validator->fails())
        {
            return redirect()->route('compliant_title.edit', $id)->withErrors($validator);
        }

        $cdc = CompliantTitle::findOrFail($id);
        $cdc->title = $request->title;
        $cdc->save();

        Session::flash('item', 'Compliant ID: '.$id.' Has Been Updated!');

        return redirect()->route('compliant_title.edit', $cdc->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->submit == 'Yes - I want Delete Compliant Title')
        {
            $this->delete_process($id);

            
                return redirect()->route('compliant_title.index');
        } elseif($request->submit == 'Finished')
        {
            return redirect()->route('compliant_title.edit', $id);
        }
    }

    public function del_config($update_id) {
        if(is_numeric($update_id))
        {
            return view('manage.compliant_title.del_config', compact('update_id'));
        }
    }

    private function delete_process($update_id)
    {   //missed delete items
        if(is_numeric($update_id))
        {
            
            CompliantTitle::where('id', $update_id)->delete();

        }
    }
}
