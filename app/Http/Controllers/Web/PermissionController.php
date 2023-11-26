<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function index(){

        $permissions = Permission::all();
        return view('permissions.index', ['permissions' => $permissions ]);
    }

    public function create(){
         
        return view('permissions.create');
    }

    public function store(Request $request){

        // $this->validate($request, [
        //     'name' => 'required|unique:users,name'
        // ]);

        Permission::create($request->only('name'));

        return redirect()->route('permissions.index')->with('success', "Permission created successfully");

    }

    public function edit(Permission $permission){

        return view('permissions.edit', [ 'permission' => $permission ]);
    }



    public function update(Request $request, Permission $permission){

        // $request->validate([
        //     'name' => 'required|unique:permissions,name,'.$permission->id
        // ]);

        $permission->update($request->only('name'));

        return redirect()->route('permissions.index')->with('success', "Permission updated successfully");

    }


    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
    }


}
