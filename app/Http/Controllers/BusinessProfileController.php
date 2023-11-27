<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use App\Exports\BusinessProfilesExport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;


class BusinessProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $b_profiles = BusinessProfile::get();
         
        return view('business-profile.index', compact('b_profiles'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {

            $date = $request->input('date');

            if ($date) {

                $startOfDay = Carbon::createFromFormat('Y-m-d', $date)->startOfDay();
                $endOfDay = $startOfDay->copy()->endOfDay();
            
                $data = BusinessProfile::where('created_at', '>=', $startOfDay)
                    ->where('created_at', '<=', $endOfDay)
                    ->get();
            
            }
            else{
                //Date Filter
                $data = BusinessProfile::get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex">';
                    $btn .= '<a class="btn btn-sm btn-info" style="margin-right: 5px;" href="'.url('business-profiles-edit/'.$row->_id).'" role="button">Edit</i></a>';
                    $btn .= '<a class="btn btn-sm btn-danger"  href="'.url('business-profiles-delete/'.$row->id).'" role="button">Del</a>';
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
        return view('business-profile.create');
    }

   
    public function store(Request $request)
    {

        $author = BusinessProfile::create($request->all());
   
        return redirect()->route('business-profiles.index')->with('success', 'Profile created successfully.');;
    }


    public function edit($id)
    {
        $businessProfile = BusinessProfile::find($id);

        return view('business-profile.edit', compact('businessProfile'));
    }

   
    public function update(Request $request, $id)
    {
        $businessProfile = BusinessProfile::find($id);

        $businessProfile->update($request->all());
        return redirect()->route('business-profiles.index')->with('success', 'Profile updated successfully.');;
    }

    
    public function destroy($id)
    {
        $businessProfile = BusinessProfile::find($id);

        $businessProfile->delete();
        return redirect()->route('business-profiles.index')->with('success', 'Profile deleted successfully.');

    }

    public function export()
    {
        return Excel::download(new BusinessProfilesExport, 'profile.xlsx');
        
    }
}
