<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use DB;
class RoleController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function index(){

        $roles = Role::all();
        return view('roles.index', compact('roles'));

    }
    
    public function create()
    {
        $permissions = Permission::get();
        return view('roles.create', compact('permissions'));
    }


    public function store(Request $request){
        
      
        // DB::connection()->enableQueryLog();

        $role = Role::create(['name' => $request->name]);
        $role->givePermissionTo([
                $request->permission
            ]);
            // dd(DB::getQueryLog());

        // return $role->syncPermissions($request->permission);

        return redirect()->route('roles.index')->with('success', "Role created successfully");

    }

    public function show(Role $role){
        $role = $role;
        $rolePermissions = $role->permissions;

        return view('roles.show', compact('role', 'rolePermissions'));
    }


    public function edit (Role $role){

        $role = $role;
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::get();

        return view('roles.edit', compact('role', 'rolePermissions', 'permissions'));
    }

    public function update(Request $request, Role $role){
        
        // $this->validate($request,[
        //     'name' => 'required',
        //     'permission' => 'required'
        // ]);


        $role->update($request->only('name'));
        $role->syncPermissions($request->get('permission'));

        return redirect()->route('roles.index')->with('success', "Role updated successfully");

    }

    public function destroy(Role $role){

        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
        
    }
}