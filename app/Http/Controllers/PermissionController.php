<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use Validator, Session, Hash;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy("id", 'desc')->paginate(15);
        return view('manage.permissions.index')->withPermissions($permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.permissions.create');
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
            return redirect()->route('permissions.index');

        if($request->r3 == 'basic') {

            $validator = Validator::make($request->all(), [
                'name'=> 'required|min:3|max:191',
                'display_name'=> 'required|min:3|max:191|alpha_dash',
                'description'=> 'required|min:5|max:191'
            ]);

            if($validator->fails())
                return redirect()->back()->withInput()->withErrors($validator->errors());

            $permission = new Permission();
            $permission->name = str_slug($request->name);
            $permission->display_name = $request->display_name;
            $permission->description = $request->display_name;
            $permission->save();
        } else {

            $validator = Validator::make($request->all(), [
                'display_name'=> 'required|min:3|max:191|alpha_dash',
            ]);

            if($validator->fails())
                return redirect()->back()->withInput()->withErrors($validator->errors());

            $crud_checked = $request->crud_checked;
            $crud_arr = explode(',', $crud_checked);
            for($i = 0; $i < count($crud_arr); $i ++ ) {
                $permission = new Permission();
                $permission->name = $crud_arr[$i] . '-' . strtolower($request->display_name);
                $permission->display_name = ucwords($crud_arr[$i]) . ' ' . ucwords($request->display_name);
                $permission->description = 'Allow User To ' . $crud_arr[$i] .  ' a ' . $request->display_name;
                $permission->save();
            }

        }

        Session::flash('item', 'Successfully Permission Has Been Added');
        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return view('manage.permissions.show')->withPermission($permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('manage.permissions.edit')->withPermission($permission); //
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
        $validator = Validator::make($request->all(), [
            'display_name'=> 'required|min:3|max:191|alpha_dash',
            'description'=> 'required|min:5|max:191'
        ]);

        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator->errors());

        $permission = Permission::findOrFail($id);
        $permission->display_name = $request->display_name;
        $permission->description = $request->display_name;
        $permission->save();

        Session::flash('item', 'Successfully Permission ID: '.$id.' Has Been Updated');
        return redirect()->route('permissions.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
 