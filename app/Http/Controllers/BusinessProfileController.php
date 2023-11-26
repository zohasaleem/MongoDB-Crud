<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use App\Exports\BusinessProfilesExport;
use Maatwebsite\Excel\Facades\Excel;

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

            if($date == null){

                $data = BusinessProfile::get();
            }

            else{
                //Date Filter
                $data = BusinessProfile::where('created_at', $date)->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function ($row) {
                    $btn = '<button class="btn btn-sm  btn-primary ml-2 p-2 display" style="margin-right: 9px;" data-type="'.$row->type.'" value="' . $row->url . '" type="button"><i class="fa fa-eye"></i></button>';
                    $btn = $btn . '<a class="btn btn-sm btn-danger ml-2 p-2" style="margin-right: 9px;" href="'.url('business-profiles/'.$row->id).'" role="button"><i class="fa fa-trash"></i></a>';
                    $btn = $btn . '<a class="btn btn-sm btn-dark ml-2 p-2" href="'.url('/business-profiles'.$row->id).'" role="button"><i class="fa fa-edit"></i></a>';
                   
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


    public function edit(BusinessProfile $businessProfile)
    {
        return view('business-profile.edit', compact('businessProfile'));
    }

   
    public function update(Request $request, BusinessProfile $businessProfile)
    {
        $businessProfile->update($request->all());
        return redirect()->route('business-profiles.index')->with('success', 'Profile updated successfully.');;
    }

    
    public function destroy(BusinessProfile $businessProfile)
    {
        $businessProfile->delete();
        return redirect()->route('business-profiles.index')->with('success', 'Profile deleted successfully.');

    }

    public function export()
    {
        return Excel::download(new BusinessProfilesExport, 'profile.xlsx');
        
    }
}
