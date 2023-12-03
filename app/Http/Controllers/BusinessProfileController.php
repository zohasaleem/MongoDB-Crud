<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use App\Exports\BusinessProfilesExport;
use App\Imports\BusinessProfileImport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class BusinessProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {          
        $time = $request->query('t');

        // $dataToday = BusinessProfile::where('created_at', Carbon::today())->count();
        $dataToday = BusinessProfile::where('created_at', '>=', Carbon::today()->startOfDay())
                                    ->where('created_at', '<', Carbon::tomorrow()->startOfDay())
                                    ->count();

        // $dataYesterday = BusinessProfile::where('created_at', '>', Carbon::yesterday())->count();
        $dataYesterday = BusinessProfile::where('created_at', '>=', Carbon::yesterday()->startOfDay())
                                        ->where('created_at', '<', Carbon::today()->startOfDay())
                                        ->count();

        $dataThisWeek = BusinessProfile::where('created_at', '>', Carbon::now()->startOfWeek())->count();
        $dataThisMonth = BusinessProfile::where('created_at', '>', Carbon::now()->startOfMonth())->count();
        $dataThisYear = BusinessProfile::where('created_at', '>', Carbon::now()->startOfYear())->count();
        $lastMonthStart = Carbon::now()->subMonth(1)->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth(1)->endOfMonth();
        
        $dataLastMonth = BusinessProfile::where('created_at', '>=', $lastMonthStart)
                                        ->where('created_at', '<=', $lastMonthEnd)
                                        ->count();



        //for graph
        $userData = BusinessProfile::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$group' => [
                        '_id' => [
                            '$dateToString' => [
                                'format' => '%Y-%m-%d',
                                'date' => '$created_at',
                            ],
                        ],
                        'count' => ['$sum' => 1],
                    ],
                ],
                [
                    '$sort' => ['_id' => 1],
                ],
            ]);
        });

        $dates = $userData->pluck('_id')->toArray();
        $counts = $userData->pluck('count')->toArray();


        // for Map
        $categories = BusinessProfile::select('name', 'category', 'latitude', 'longitude')->get();
        
        return view('business-profile.index',compact('dataToday','dataYesterday','dataThisWeek','dataThisMonth','dataThisYear','time','dataLastMonth', 'dates', 'counts', 'categories'));
    }

    // lists data in data table
    public function getData(Request $request)
    {
        set_time_limit(300);

        if ($request->ajax()) {

            $time = $request->input('time');
            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');
            

            if($time == 'week'){
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
            
            if($request->input('time') == 'yesterday'){
                
                $yesterday =  Carbon::yesterday()->startOfDay();
                $today = Carbon::today()->startOfDay();

                $data = BusinessProfile::where('created_at', '>=', $yesterday)
                                        ->where('created_at', '<', $today)
                                        ->get();
            }
                
            elseif($request->input('time') == 'lastmonth'){

                $lastMonthStart = Carbon::now()->subMonth(1)->startOfMonth();
                $lastMonthEnd = Carbon::now()->subMonth(1)->endOfMonth();

                $data = BusinessProfile::where('created_at', '>=', $lastMonthStart)
                ->where('created_at', '<=', $lastMonthEnd)
                ->get();

                // foreach($data as $r)
                // {
                //     $r->user = Users::where('_id',$r->user_id)->first(); 
                // }
                                    
            }
                        

            elseif($fromDate != null && $toDate != null){

                $startOfDay = Carbon::createFromFormat('Y-m-d', $fromDate)->startOfDay();
                $endOfDay = Carbon::createFromFormat('Y-m-d', $toDate)->endOfDay();

                $data = BusinessProfile::whereBetween('created_at', [$startOfDay, $endOfDay])->get();
            
            }

         
            else{
                    $data = BusinessProfile::where('created_at', '>', $dt)->orderBy('_id','desc')->limit(10000)->get();
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
                // ->addColumn('lat_lng', function ($row) {
                //     return '<div > <input type="checkbox" class="marker-checkbox" data-lat="' . $row->latitude . '" data-lng="' . $row->longitude . '" checked  style="margin-right: 10px;" >'.$row->category.'</div>';

                //     })
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

    // generate new record
    public function store(Request $request)
    {

        BusinessProfile::create($request->all());
   
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

    // delete
    public function destroy($id)
    {
        $businessProfile = BusinessProfile::find($id);

        $businessProfile->delete();
        return redirect()->route('business-profiles.index')->with('success', 'Profile deleted successfully.');

    }

    
    // for eporting data
    public function export(Request $request)
    {

        $time = $request->input('filterType');
        $fromDate = $request->input('exportFromDate');
        $toDate = $request->input('exportToDate');

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


    // for importing data
    public function import(Request $request){

        
        set_time_limit(300);

        $file = $request->file('file');

        Excel::import(new BusinessProfileImport, $request->file('file')->store('files'));

        return redirect()->route('business-profiles.index');

    }

    // for Map
    public function showMap(){

        $dataForMap = BusinessProfile::select('name', 'latitude', 'longitude')->get();

        return response()->json(['dataForMap' => $dataForMap]);

    }

}
