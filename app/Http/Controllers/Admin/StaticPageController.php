<?php

namespace App\Http\Controllers\Admin;

use App\StaticPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DataTables;

class StaticPageController extends Controller
{
    /**
     * Create a StaticPage controller instance.
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
        return view('admin.pages.index');
    }


    /**
     * Get StaticPage List From DB  For Datatables
     *
     * @return \Illuminate\Http\Response
    */
    public function getPagesData()
    {
        $users = StaticPage::latest()->get();
        
        return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('edit', function($row){

                   $btn = '<a href="'.url('/admin/edit-page/').'/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';

                    return $btn;
                })
                ->addColumn('show', function($row){

                   $btn = '<a href="'.url('/admin/show-page/').'/'.$row->id.'" target="_blank" class="show btn btn-info btn-sm">Show</a>';

                    return $btn;
                })
                ->addColumn('delete', function($row){
                   $btn = '<button  onclick="deleteArtist('.$row->id.');" class="delete btn btn-danger btn-sm">Delete</button>';

                    return $btn;
                })
                ->rawColumns(['show', 'edit', 'delete'])
                ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');   
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

        $page = StaticPage::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('admin.pages')->with('success', 'Page Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = StaticPage::where(['id'=>$id])->first();
        return view('admin.pages.show', [ 'page' => $page]);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $page = StaticPage::where(['id'=>$id])->first();
        return view('admin.pages.edit', [ 'page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $request->validate([
            'title' => 'required|min:3|max:255',
        ]);

        $data = [
            'title' => $request->title,
            'body' => $request->body,
        ];

        $page = StaticPage::where('id', $request->id)
            ->update($data);

        return redirect()->route('admin.pages')->with('success', 'Page Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $user = StaticPage::where('id', $id)->firstorfail()->delete();
        return redirect()->route('admin.pages')->with('success', 'Page Removed Successfully!');
    }
}
