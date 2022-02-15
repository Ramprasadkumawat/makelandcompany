<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Country;
use App\State;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CityController extends Controller
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
        return view('admin.cities.index');
    }
 
    /**
     * Get City List From DB  For Datatables
     *
     * @return \Illuminate\Http\Response
    */
    public function getCitiesData()
    {
        //$cities = City::has('country', 'state')->latest()->get();

        $cities = City::leftJoin('states', 'states.id', '=', 'cities.state_id')
        ->leftJoin('countries', 'countries.id', '=', 'cities.country_id')
        ->orderBy('cities.id', 'desc')
        ->select('cities.id', 'cities.name', 'states.name as state_name', 'countries.name as country_name')->get();

        return Datatables::of($cities)
                ->addIndexColumn()
                ->editColumn('name', function($row) {
                    return Str::limit($row->name, 20, $end='.......');
                })
                ->addColumn('country_name', function($row){
                    return Str::limit($row->country_name, 20, $end='.......');
                  
                })
                ->addColumn('state_name', function($row){
                    
                    return Str::limit($row->state_name, 20, $end='.......');
                })
                ->addColumn('edit', function($row){

                   $btn = '<a href="'.url('admin/edit-city/').'/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';

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
        $countries = Country::all();
        return view('admin.cities.create', ['countries' => $countries]);   
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

            'name' => 'required|min:3|unique:cities|max:255',
            'country_id' => 'required',
            'state_id' => 'required',
        ]);

        $city = City::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
        ]);

        return redirect()->route('admin.cities')->with('success', 'City Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('admin.cities.edit');  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::all();
        $city = City::where(['id'=>$id])->first();

        $states = State::where('country_id', $city->country_id)->get(['id','name']);

        return view('admin.cities.edit', [ 'city' => $city, 'states' => $states, 'countries' => $countries]);
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

            'name' => 'required|min:3|max:255|unique:cities,name, '. $request->id . ',id',
            'country_id' => 'required',
            'state_id' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
        ];

        
        $city = City::where('id', $request->id)
            ->update($data);

        return redirect()->route('admin.cities')->with('success', 'City Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        City::where('id', $id)->firstorfail()->delete();
        return redirect()->route('admin.cities')->with('success', 'City Removed Successfully!');
    }
}
