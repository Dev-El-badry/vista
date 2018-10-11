<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestOption;
use Validator, DB, Session;

class RequestOptionsController extends ManageController
{
    public function index() {
       
        $request_options = RequestOption::all();
        return view('manage.request_options.index', compact('request_options'));
    }

    public function create() {
        
        return view('manage.request_options.create');
    }

    public function store(Request $request) {
        $requests = $request->only('title', 'submit');
        $rules = [
            'title'=> 'required|min:3',
        ];

        if($request->submit == 'Cancel')
            return redirect()->route('request_options.index');

        $validator = Validator::make($requests, $rules);
        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $request_option = new RequestOption();
        $request_option->title = $request->title;
        $request_option->save();

        Session::flash('item', 'Successfully Added New Request Option Option!');
        return redirect()->route('request_options.edit', $request_option->id);
    }

    public function edit($update_id) {
       
        $request_option = RequestOption::findOrFail($update_id);
       
        return view('manage.request_options.edit', compact( 'request_option'));
    }

    public function update(Request $request, $update_id) {
        $requests = $request->only('title', 'submit');
        $rules = [
            'title'=> 'required|min:3',
        ];

        if($request->submit == 'Cancel')
            return redirect()->route('request_options.index');

        $validator = Validator::make($requests, $rules);
        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $request_option = RequestOption::findOrFail($update_id);
        $request_option->title = $request->title;
        $request_option->save();

        Session::flash('item', 'Successfully Added New Request Option Option!');
        return redirect()->route('request_options.edit', $request_option->id);
    }

    public function delete_config($update_id) {
        return view('manage.request_options.delete_config', compact('update_id'));
    }

    public function destroy(Request $request, $update_id) {
        $request_option = RequestOption::findOrFail($update_id);
        $request_option->delete();

        Session::flash('item_del', 'Successfully Delete Request Option Option!');
        return redirect()->route('request_options.index');
    }
}
