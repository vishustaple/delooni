<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use DB;
class UserController extends Controller
    {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->get();
       return view('admin.users.create',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.rolesPermissions.create',compact('roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
       {
        //
        $request->validate([
            'role'=>'required|integer',
            'permissions'=>'required|array',
        ]);
        $role= Role::find($request->role);
        $role->givePermissionTo($request->permissions);
        return redirect()->route('rolesPermission.index')->with('success','permissions has Sucessfully Assigned');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $roles = Role::all();
        $user= User::with('roles')->find($id);
        $rolesdata =[];
            foreach($user->roles as $role){
                array_push($rolesdata,$role->id);
            }
        return view('admin.users.update',compact('roles','rolesdata','user'));
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
        $request->validate([
            'roles'=>'required|array',
        ]);
        $user= User::findOrFail($id);
        $user->syncRoles($request->roles);
        return redirect()->route('manage-users')->with('success','Roles has Sucessfully Assigned');
    }

    
  

}
