<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
class RolesPermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $roles = Role::with('permissions')->get();
        // $permissions = Permission::all();
        // return view('admin.rolesPermissions.create',compact('roles','permissions'));
        $roles = Role::with('permissions')->get();
       
        return view('admin.rolesPermissions.index',compact('roles'));
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
        // Role::create(['name' => $request->role]);
        // dd($request->permissions);
        
        $role= Role::find($request->role);
        $role->givePermissionTo($request->permissions);
        return redirect()->route('rolesPermission.index')->with('success','permissions has Sucessfully Assigned');
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
    public function edit(Request $request ,$id)
    {
        // $id = $request->id;
        $roles = Role::all();
        $permissions = Permission::all();
        $roledata= Role::with('permissions')->find($id);
        $permissionsdata =[];
            foreach($roledata->permissions as $per){
                array_push($permissionsdata,$per->id);
            }
        return view('admin.rolesPermissions.update',compact('roles','permissions','roledata','permissionsdata'))->render();
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
            'role'=>'required|integer',
            'permissions'=>'required|array',
        ]);
        $role= Role::findOrFail($id);
        $delData = DB::table("role_has_permissions")->where('role_id',$request->role)->whereNotIn('permission_id',$request->permissions)->delete();
        $role->givePermissionTo($request->permissions);
        // dd($delData);
        $role->syncPermissions($request->permissions);
        return redirect()->route('rolesPermission.index')->with('success','permissions has Sucessfully Assigned');
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
