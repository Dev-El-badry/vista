<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use Validator, Session;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('manage.roles.index')->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view("manage.roles.create")->withPermissions($permissions);
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
            return redirect()->route('roles.show', $id);

        $validator = Validator::make($request->all(), [
            'display_name'=> 'required|min:3|max:191',
            'description'=> 'required|min:5|max:191',
            'name'=> 'required|min:3|max:191|unique:roles',
            
        ]);

        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator->errors());

        $role = new Role();
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        if($request->cruds_checked != null)
            $role->syncPermissions(explode(',', $request->cruds_checked));

        Session::flash('item', 'Successfully! Role Has Been Added');
        return redirect()->route('roles.show', $role->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::where('id', $id)->with('permissions')->first();
        return view('manage.roles.show')->withRole($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::where('id', $id)->with('permissions')->first();
        $arrayIds = [];
        foreach ($role->permissions as $row) {
            array_push($arrayIds, $row->id); 
        }

        $permissions = Permission::all();
        return view('manage.roles.edit')->withRole($role)->withPermissions($permissions)->withArrayIds($arrayIds);
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
            return redirect()->route('roles.show', $id);

        $validator = Validator::make($request->all(), [
            'display_name'=> 'required|min:3|max:191',
            'description'=> 'required|min:5|max:191',
            
        ]);

        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator->errors());

        $role = Role::findOrFail($id);
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        if($request->cruds_checked != null)
            $role->syncPermissions(explode(',', $request->cruds_checked));

        Session::flash('item', 'Successfully! Role ID: '.$role->id.' Has Been Updated');
        return redirect()->route('roles.show', $role->id);
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
