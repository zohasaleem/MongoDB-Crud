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

    public function index(Request $request)
    {          
        $time = $request->query('t');

        $dataToday = BusinessProfile::where('created_at', Carbon::today())->count();
        $dataYesterday = BusinessProfile::where('created_at', '>', Carbon::yesterday())->count();
        $dataThisWeek = BusinessProfile::where('created_at', '>', Carbon::now()->startOfWeek())->count();
        $dataThisMonth = BusinessProfile::where('created_at', '>', Carbon::now()->startOfMonth())->count();
        $dataThisYear = BusinessProfile::where('created_at', '>', Carbon::now()->startOfYear())->count();
        $lastMonthStart = Carbon::now()->subMonth(1)->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth(1)->endOfMonth();
        
        $dataLastMonth = BusinessProfile::where('created_at', '>=', $lastMonthStart)
                                        ->where('created_at', '<=', $lastMonthEnd)
                                        ->count();


        return view('business-profile.index',compact('dataToday','dataYesterday','dataThisWeek','dataThisMonth','dataThisYear','time','dataLastMonth'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {

            $time = $request->input('t');
            
            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');
            

            if($time == 'yesterday'){
                $dt = Carbon::yesterday();
            }

            elseif($time == 'week'){
                $dt = Carbon::now()->startOfWeek();
            }

            elseif($time == 'month'){
                $dt = Carbon::now()->startOfMonth();
            }

            elseif($time == 'year'){
                $dt = Carbon::now()->startOfYear();
            }  
            
            else{
                $time = 'today';
                $dt = Carbon::today();
            }
                
            if($request->query('t') =='lastmonth'){

                $lastMonthStart = Carbon::now()->subMonth(1)->startOfMonth();
                $lastMonthEnd = Carbon::now()->subMonth(1)->endOfMonth();

                $data = BusinessProfile::where('created_at', '>=', $lastMonthStart)
                                        ->where('created_at', '<=', $lastMonthEnd)
                                        ->get();

                foreach($data as $r)
                {
                    $r->user = Users::where('_id',$r->user_id)->first();   
                }

            }            

            elseif($fromDate != null && $toDate != null){

                $startOfDay = Carbon::createFromFormat('Y-m-d', $fromDate)->startOfDay();
                $endOfDay = Carbon::createFromFormat('Y-m-d', $toDate)->endOfDay();

                $data = BusinessProfile::whereBetween('created_at', [$startOfDay, $endOfDay])->get();
            
            }

         
            else{
                    $data = BusinessProfile::where('created_at', '>', $dt)->orderBy('_id','desc')->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex">';                 
                    $btn .= '<a class="btn btn-sm btn-primary" style="margin-right: 5px;" href="'.url('/user-details?username='.$row->phone).'" role="button">View</i></a>';
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

    public function export(Request $request)
    {

        
        $time = $request->input('filterType');
        $fromDate = $request->input('exportFromDate');
        $toDate = $request->input('exportToDate');
// return response()->json(["fromDate" => $fromDate, "toDate" => $toDate]);
        if($fromDate != null && $toDate != null){

            $startOfDay = Carbon::createFromFormat('Y-m-d', $fromDate)->startOfDay();
            $endOfDay = Carbon::createFromFormat('Y-m-d', $toDate)->endOfDay();

            $data = BusinessProfile::whereBetween('created_at', [$startOfDay, $endOfDay])->get();
            // return response()->json(["data" => $data]);
            $export = new BusinessProfilesExport($data);

            return Excel::download($export, 'profile.xlsx');

        }
   
        if($time == 'yesterday'){
            $dt = Carbon::yesterday();
        }

        elseif($time == 'week'){
            $dt = Carbon::now()->startOfWeek();
        }

        elseif($time == 'month'){
            $dt = Carbon::now()->startOfMonth();
        }

        elseif($time == 'year'){
            $dt = Carbon::now()->startOfYear();
        }  
        
       
            
        elseif($request->query('t') =='lastmonth'){

            $lastMonthStart = Carbon::now()->subMonth(1)->startOfMonth();
            $lastMonthEnd = Carbon::now()->subMonth(1)->endOfMonth();

            $data = BusinessProfile::where('created_at', '>=', $lastMonthStart)
                                    ->where('created_at', '<=', $lastMonthEnd)
                                    ->get();

            foreach($data as $r)
            {
                $r->user = Users::where('_id',$r->user_id)->first();   
            }

        }

        else{
            $time = 'today';
            $dt = Carbon::today();
        }

     
        $data = BusinessProfile::where('created_at', '>', $dt)->orderBy('_id','desc')->get();
        
        $export = new BusinessProfilesExport($data);

        // return response()->json(["data" => $data]);
        return Excel::download($export, 'profile.xlsx');
        
    }


}
