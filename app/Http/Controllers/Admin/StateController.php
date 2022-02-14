<?php

namespace App\Http\Controllers\Admin;

use App\State;
use App\Country;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StateController extends Controller
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
        return view('admin.states.index');
    }
 
    /**
     * Get Country List From DB  For Datatables
     *
     * @return \Illuminate\Http\Response
    */
    public function getStatesData()
    {
        $states = State::with('country')->latest()->get();
        
        return Datatables::of($states)
                ->addIndexColumn()
                ->addColumn('country_name', function($row){
                    return $row->country->name;
                })
                ->addColumn('edit', function($row){

                   $btn = '<a href="'.url('admin/edit-state/').'/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';

                    return $btn;
                })
                ->addColumn('delete', function($row){
                   $btn = '<button  onclick="deleteArtist('.$row->id.');" class="delete btn btn-danger btn-sm">Delete</button>';

                    return $btn;
                })
                ->rawColumns(['country_name', 'edit', 'delete'])
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
        return view('admin.states.create', ['countries' => $countries]);   
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
            'name' => 'required|min:2|max:255',
            'country_id' => 'required',
        ]);

        $country = State::create([
            'name' => $request->name,
            'country_id'=> $request->country_id,
        ]);

        return redirect()->route('admin.states')->with('success', 'State Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('admin.states.edit');  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::all();
        $state = State::where(['id'=>$id])->first();
        
        return view('admin.states.edit', [ 'state' => $state, 'countries' => $countries]);
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
            'name' => 'required|min:2|max:255',
            'country_id' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'country_id' => $request->country_id,
        ];

        $state = State::where('id', $request->id)
            ->update($data);

        return redirect()->route('admin.states')->with('success', 'State Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $user = State::where('id', $id)->firstorfail()->delete();
        return redirect()->route('admin.states')->with('success', 'State Removed Successfully!');
    }
}
