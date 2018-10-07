<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Validator;
use App\ChronicDiseaseCategory;
use Input;
class ChronicDiseaseCategoryController extends Controller
{

    public function active_request(Request $request) {
        $id = $request->id;
        if(is_numeric($id)) {
            $cdc = ChronicDiseaseCategory::findOrFail($id);
            $cdc->status = 1;
            $cdc->save();

            return 1;
        }

        return 0;
    }

    public function delete_request(Request $request) {
        $id = $request->id;
        if(is_numeric($id)) {
            $cdc = ChronicDiseaseCategory::findOrFail($id);
            $cdc->delete();

            return 1;
        }

        return 0;
    }

    public function get_requests() {
        $requests = ChronicDiseaseCategory::where("status", '=', '0')->paginate(15);
        return view('manage.cronic_disease_category.get_requests')->withRequests($requests);
    }

    private static function get_parent_title($parent_id)
    {
        if(is_numeric($parent_id))
        {
            $cdc = ChronicDiseaseCategory::where('parent_id', $parent_id)->first();
            $cat_parent_title = $cdc->cd_title;
            return $cat_parent_title;
        }
    }



    private function get_dropdown_categories()
    {
        $options[0] = 'Please Select Chronic Disease Category';
        $cdcs = ChronicDiseaseCategory::where('parent_id', '=', 0)->get();
        foreach ($cdcs as $row) {
            $str = '';
           
                $str .= $row->cd_title ;
           
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
            $cdc= ChronicDiseaseCategory::findOrFail($update_id);
            $cdc->priority = $i+1;
            $cdc->save();
        }
      
    }

    public static function get_count_categories($parent_id)
    {
        $categories_count = ChronicDiseaseCategory::where('parent_id', '=', $parent_id)->where('status', '=', 1)->count();
        return $categories_count;
    }

    public static function get_sortable_list($parent_id, $status) {

        $status_val = Input::get('status');
        if(!isset($status_val))
            $status_val = 1;

        $data['categories'] = ChronicDiseaseCategory::where('parent_id', '=', $parent_id)
                                    ->where('status', '=', 1)
                                    ->orderBy('priority', 'asc')
                                    ->get();

        $data['this_site'] = TRUE;

        return view('manage.cronic_disease_category.sort_list', compact('data', 'status'))->render();
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

        return view('manage.cronic_disease_category.index')->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['options'] = $this->get_dropdown_categories();
        return view('manage.cronic_disease_category.create')->withData($data);
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
            return redirect()->route('cronic_disease_category.index');
        }

        $validator = Validator::make($request->all(), [
            'cd_title' => 'required|unique:chronic_disease_categories,cd_title',
            'parent_id'=> 'required|numeric',
        ]);

        if($validator->fails())
        {
            return redirect()->route('cronic_disease_category.create')->withErrors($validator);
        }

        $cdc = new ChronicDiseaseCategory();
        $cdc->cd_title = $request->cd_title;
        $cdc->status = 1;
        $cdc->parent_id = $request->parent_id;
        $cdc->save();

        Session::flash('item', 'Successfully Added Category !');

        return redirect()->route('cronic_disease_category.edit', $cdc->id);
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
        $cdc = ChronicDiseaseCategory::findOrFail($id);
        $data['options'] = $this->get_dropdown_categories();
        return view('manage.cronic_disease_category.edit')->withCdc($cdc)->withData($data);
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
            
            return redirect()->route('cronic_disease_category.index');
        }

        $validator = Validator::make($request->all(), [
            'cd_title' =>  'required|unique:chronic_disease_categories,cd_title,'.$id,
            'parent_id'=> 'required|numeric',
           
        ]);


        if($validator->fails())
        {
            return redirect()->route('cronic_disease_category.edit', $id)->withErrors($validator);
        }

        $cdc = ChronicDiseaseCategory::findOrFail($id);
        $cdc->cd_title = $request->cd_title;

        $cdc->parent_id = $request->parent_id;
        $cdc->save();

        Session::flash('item', 'Category ID: '.$id.' Has Been Updated!');

        return redirect()->route('cronic_disease_category.edit', $cdc->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->submit == 'Yes - I want Delete Chronic Disease Category')
        {
            $this->delete_process($id);

            
                return redirect()->route('cronic_disease_category.index');
        } elseif($request->submit == 'Finished')
        {
            return redirect()->route('cronic_disease_category.edit', $id);
        }
    }

    public function del_config($update_id) {
        if(is_numeric($update_id))
        {
            return view('manage.cronic_disease_category.del_config', compact('update_id'));
        }
    }

    private function delete_process($update_id)
    {   //missed delete items
        if(is_numeric($update_id))
        {
            
            ChronicDiseaseCategory::where('parent_id', $update_id)->delete();
            ChronicDiseaseCategory::where('id', $update_id)->delete();

        }
    }
}
