<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Exports\AuthorsExport;
use Maatwebsite\Excel\Facades\Excel;


class AuthorController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $date = $request->input('date');

            if($date == null){

                $authors = Author::all();
            }

            else{

                //Date Filter
                $authors = Author::where('created_at', $date)->get();
            }    

        return view('authors.index', compact('authors'));
    }

    public function getData(Request $request)
    {
        
        if ($request->ajax()) {

            $date = $request->input('date');

            if($date == null){

                $data = Author::get();
            }

            else{
                //Date Filter
                $data = Author::where('created_at', $date)->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function ($row) {
                    $btn = '<button class="btn btn-sm  btn-primary ml-2 p-2 display" style="margin-right: 9px;" data-type="'.$row->type.'" value="' . $row->url . '" type="button"><i class="fa fa-eye"></i></button>';
                    $btn = $btn . '<a class="btn btn-sm btn-danger ml-2 p-2" style="margin-right: 9px;" href="'.url('authors/'.$row->id).'" role="button"><i class="fa fa-trash"></i></a>';
                    $btn = $btn . '<a class="btn btn-sm btn-dark ml-2 p-2" href="'.url('/authors'.$row->id).'" role="button"><i class="fa fa-edit"></i></a>';
                   
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
        return view('authors.create');
    }

   
    public function store(Request $request)
    {

        $author = Author::create($request->all());
   
        return redirect()->route('authors.index')->with('success', 'Profile created successfully.');;
    }


    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

   
    public function update(Request $request, Author $author)
    {
        $author->update($request->all());
        return redirect()->route('authors.index')->with('success', 'Profile updated successfully.');;
    }

    
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Profile deleted successfully.');

    }

    public function export()
    {
        return Excel::download(new AuthorsExport, 'profile.xlsx');
        
    }
}
