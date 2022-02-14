<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Create a User controller instance.
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
        return view('admin.countries.index');
    }
 
    /**
     * Get Country List From DB  For Datatables
     *
     * @return \Illuminate\Http\Response
    */
    public function getCountriesData()
    {
        $countries = Country::latest()->get();
        
        return Datatables::of($countries)
                ->addIndexColumn()
                ->addColumn('edit', function($row){

                   $btn = '<a href="'.url('admin/edit-country/').'/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';

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
        return view('admin.countries.create');   
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
            'name' => 'required|min:3|max:255',
        ]);

        $country = Country::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.countries')->with('success', 'Country Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('admin.countries.edit');  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::where(['id'=>$id])->first();
        
        return view('admin.countries.edit', [ 'country' => $country]);
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
            'name' => 'required|min:3|max:255',
        ]);

        $data = [
            'name' => $request->name,
        ];

        $country = Country::where('id', $request->id)
            ->update($data);

        return redirect()->route('admin.countries')->with('success', 'Country Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $user = Country::where('id', $id)->firstorfail()->delete();
        return redirect()->route('admin.countries')->with('success', 'Country Removed Successfully!');
    }
}
