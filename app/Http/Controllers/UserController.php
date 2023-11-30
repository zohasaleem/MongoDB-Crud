<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use AptCD\Permission\Models\Role;
use AptCD\Permission\Models\Permission;
use Carbon\Carbon;
use Hash;

class UserController extends Controller
{

    public function index(){

        return view('user.index');
    }


    public function getUserData(Request $request){

        if($request->ajax()){

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            if($fromDate && $toDate){

                $startOfDay = Carbon::createFromFormat('Y-m-d', $fromDate)->startOfDay();
                $endOfDay = Carbon::createFromFormat('Y-m-d', $toDate)->endOfDay();

                $data = User::whereBetween('created_at', [$startOfDay, $endOfDay])->get();

            } else{

                $data = User::get();
            }

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '<div class="d-flex">';                 
                $btn .= '<a class="btn btn-sm btn-primary" style="margin-right: 5px;" href="'.url('users-details/'.$row->_id).'" role="button">View</i></a>';
                $btn .= '<a class="btn btn-sm btn-info" style="margin-right: 5px;" href="'.url('users-edit/'.$row->_id).'" role="button">Edit</i></a>';
                $btn .= '<a class="btn btn-sm btn-danger"  href="'.url('users-delete/'.$row->id).'" role="button">Del</a>';
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


    public function details($id){

        $user = User::find($id);

        return view('user.details', compact('user'));
    }


    public function edit($id)
    {

        $user = User::find($id);
        
        $roles = Role::get();

        // return $user->roles;
       
        return view('user.edit', compact('user', 'roles'));
    }

   
    public function update(Request $request)
    {
        $user = User::find($request->id);
       
        if ($user) {

            $user->update($request->except('role_id'));

            $user->roles()->sync([$request->input('role_id')]);

            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        }
    }

    
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');

    }


    public function profilePage(){

        return view('user.profile');
    }

    public function updateUserProfile(Request $request)
    {   

        $user = User::find($request->id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // if ($request->has('password')) {
        //     $user->password = Hash::make($request->input('password'));
        // }
        
        $user->save();
        return redirect()->route('users.detail');
    }
}
