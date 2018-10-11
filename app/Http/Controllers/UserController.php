<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Validator, Session, Hash;

class UserController extends ManageController   
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(15);
        return view('manage.users.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('manage.users.create')->withRoles($roles);
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
            return redirect()->route('users.index');

        $validator = Validator::make($request->all(), [
            'name'=> 'required|min:3|max:191',
            'email'=> 'required|email|max:191|unique:users,email',
            'password'=> 'required|min:6|max:191'
        ]);

        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator->errors());

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        if($request->cruds_checked != null)
            $user->syncRoles(explode(',', $request->cruds_checked));

        Session::flash('item', 'Successfully Has Been Added User!');
        return redirect()->route('users.show', $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->with('roles')->first();

        return view('manage.users.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->with('roles')->first();
        $roles = Role::all();
        $arrayIds = [];
        foreach ($user->roles as $row) {
            array_push($arrayIds, $row->id); 
        }
        return view('manage.users.edit')->withUser($user)->withArrayIds($arrayIds)->withRoles($roles);
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
            return redirect()->route('users.show', $id);
        $validator = Validator::make($request->all(), [
            'name'=> 'required|min:3|max:191',
            'email'=> 'required|email|max:191|unique:users,email,'.$id,
        ]);

        if($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator->errors());

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(($user->password != null) AND ($user->auto == TRUE)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

       
        if($request->cruds_checked != null){
           
            $user->syncRoles(explode(',', $request->cruds_checked));
        }

        Session::flash('item', 'Successfully User ID: ' . $id . 'has been updated! ');
        return redirect()->route('users.show', $id);
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
