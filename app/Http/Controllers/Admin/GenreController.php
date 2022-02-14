<?php

namespace App\Http\Controllers\Admin;

use App\Genre;
use App\Http\Controllers\Controller;
use DataTables;
use Validator;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    
    /**
     * Create a Genre controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.genres.index');
    }


    /**
     * Get Genre List From DB  For Datatables
     *
     * @return \Illuminate\Http\Response
    */
    public function getGenresData()
    {
        $genres = Genre::latest()->get();
        
        return Datatables::of($genres)
                ->addIndexColumn()
                ->addColumn('edit', function($row){

                   $btn = '<a href="'.url('admin/edit-genre/').'/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';

                    return $btn;
                })
                ->addColumn('delete', function($row){
                   $btn = '<button  onclick="deleteArtist('.$row->id.');" class="delete btn btn-danger btn-sm">Delete</button>';

                    return $btn;
                })
                ->rawColumns(['edit', 'delete'])
                ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genres.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|min:3|max:255',
        ]);

            
        $artist = Genre::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.genres')->with('success', 'Genre Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('admin.genres.edit');  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genre = Genre::where(['id'=>$id])->first();
        
        return view('admin.genres.edit', [ 'genre' => $genre]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $request->validate([
            'title' => 'required|min:3|max:255',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        
        $artist = Genre::where('id', $request->id)
            ->update($data);

        return redirect()->route('admin.genres')->with('success', 'Genre Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $user = Genre::where('id', $id)->firstorfail()->delete();
        return redirect()->route('admin.genres')->with('success', 'Genre Removed Successfully!');
    }
}
