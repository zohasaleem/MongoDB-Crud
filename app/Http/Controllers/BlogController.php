<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {          
        return view('blog.index');
    }

    public function getData(Request $request)
    {

        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');
            
            if($fromDate != null && $toDate != null){

                $startOfDay = Carbon::createFromFormat('Y-m-d', $fromDate)->startOfDay();
                $endOfDay = Carbon::createFromFormat('Y-m-d', $toDate)->endOfDay();

                $data = Blog::whereBetween('created_at', [$startOfDay, $endOfDay])->get();
            
            }
         
            else{
                    $data = Blog::get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex">';                 
                    $btn .= '<a class="btn btn-sm btn-info" style="margin-right: 5px;" href="'.url('blogs-edit/'.$row->_id).'" role="button">Edit</i></a>';
                    $btn .= '<a class="btn btn-sm btn-danger"  href="'.url('blogs-delete/'.$row->id).'" role="button">Del</a>';
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
        return view('blog.create');
    }

   
    public function store(Request $request)
    {

        Blog::create($request->all());
   
        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');;
    }


    public function edit($id)
    {
        $blog = Blog::find($id);

        return view('blog.edit', compact('blog'));
    }

   
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

        $blog->update($request->all());
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');;
    }

    
    public function destroy($id)
    {
        $blog = Blog::find($id);

        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');

    }
}
