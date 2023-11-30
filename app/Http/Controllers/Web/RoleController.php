<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AptCD\Permission\Models\Role;
use AptCD\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
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


    public function getRoleData(Request $request)
    {
        
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');          

            if($fromDate != null && $toDate != null){

                $startOfDay = Carbon::createFromFormat('Y-m-d', $fromDate)->startOfDay();
                $endOfDay = Carbon::createFromFormat('Y-m-d', $toDate)->endOfDay();

                $data = Role::whereBetween('created_at', [$startOfDay, $endOfDay])->get();
            
            }
         
            else{
                    $data = Role::orderBy('_id','desc')->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function ($row) {
                  
                    $btn = '<div class="d-flex">';                 
                    $btn .= '<a class="btn btn-sm btn-primary" style="margin-right: 5px;" href="'.url('roles-show/'.$row->_id).'" role="button">View</i></a>';
                    $btn .= '<a class="btn btn-sm btn-info" style="margin-right: 5px;" href="'.url('roles-edit/'.$row->_id).'" role="button">Edit</i></a>';
                    $btn .= '<a class="btn btn-sm btn-danger"  href="'.url('roles-delete/'.$row->id).'" role="button">Del</a>';
                    $btn .= '</div>';

                    return $btn;
                }) 
                ->addColumn('created', function ($row) {
        
                    $created_at = $row->created_at;
    
                    $formatted_date = Carbon::parse($created_at)->format('Y-m-d H:i:s');
                    return $formatted_date;
                })
                
                ->rawColumns(['action', 'created'])
                ->make(true);

        }
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

    public function show($id){
        $role = Role::find($id);
        $rolePermissions = $role->permissions;
        // return $rolePermissions;
        return view('roles.show', compact('role', 'rolePermissions'));
    }


    public function edit ($id){

        $role = Role::find($id);
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        $permissions = Permission::get();

        return view('roles.edit', compact('role', 'rolePermissions', 'permissions'));
    }

    public function update(Request $request, $id){
        
        $role = Role::find($id);

        $role->update($request->only('name'));
        $role->syncPermissions($request->get('permission'));

        return redirect()->route('roles.index')->with('success', "Role updated successfully");

    }

    public function destroy($id){

        $role = Role::find($id);
        $role->delete();
        
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
        
    }
}