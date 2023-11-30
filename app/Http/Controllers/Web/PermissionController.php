<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AptCD\Permission\Models\Role;
use AptCD\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class PermissionController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function index(){

        $permissions = Permission::get();
        return view('permissions.index', [ 'permissions' => $permissions ]);
    }

    public function getPermissionData(Request $request)
    {
        
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');          

            if($fromDate != null && $toDate != null){

                $startOfDay = Carbon::createFromFormat('Y-m-d', $fromDate)->startOfDay();
                $endOfDay = Carbon::createFromFormat('Y-m-d', $toDate)->endOfDay();

                $data = Permission::whereBetween('created_at', [$startOfDay, $endOfDay])->get();
            
            }
         
            else{
                    $data = Permission::orderBy('_id','desc')->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function ($row) {
                  
                    $btn = '<div class="d-flex">';                 
                    $btn .= '<a class="btn btn-sm btn-info" style="margin-right: 5px;" href="'.url('permissions-edit/'.$row->_id).'" role="button">Edit</i></a>';
                    $btn .= '<a class="btn btn-sm btn-danger"  href="'.url('permissions-delete/'.$row->id).'" role="button">Del</a>';
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

    public function create(){
         
        return view('permissions.create');
    }

    public function store(Request $request){

        Permission::create($request->only('name'));

        return redirect()->route('permissions.index')->with('success', "Permission created successfully");

    }

    public function edit($id){

        $permission = Permission::find($id);

        return view('permissions.edit', [ 'permission' => $permission ]);
    }



    public function update(Request $request, $id){

        $permission = Permission::find($id);
        $permission->update($request->only('name'));

        return redirect()->route('permissions.index')->with('success', "Permission updated successfully");

    }


    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
    }


}
