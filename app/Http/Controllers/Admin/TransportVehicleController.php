<?php

namespace App\Http\Controllers\admin;

use App\Village;
use App\City;
use App\Coldstore;
use App\Gadi;
use DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TransportVehicleController extends Controller
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
        return view('admin.transport-vehicle.index');
    }
 
    /**
     * Get User List From DB  For Datatables
     *
     * @return \Illuminate\Http\Response
    */
    public function getTransportVehiclesData()
    {
        $gadies = Gadi::latest()->get();
        return Datatables::of($gadies)
                ->addIndexColumn()
                
                ->addColumn('edit', function($row){

                   $btn = '<a href="'.url('admin/edit-transport-vehicle/').'/'.base64_encode($row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';

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
        return view('admin.transport-vehicle.create');   
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
            'name' => 'required|min:1|max:255',
            'capacity' => 'required',
            'capacity_weight' => 'required',
            'status' => 'required',
        ]);

        $transportvehicle = Gadi::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'capacity_weight' => $request->capacity_weight,
            'status' => $request->status,
            
        ]);

        return redirect()->route('admin.transport-vehicle')->with('success', 'Transport-Vehicle Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('admin.villages.edit');  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $transportvehicle = Gadi::where(['id'=>$id])->first();

        return view('admin.transport-vehicle.edit', [ 'transportvehicle' => $transportvehicle]);
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
            'name' => 'required|min:1|max:255',
            'capacity' => 'required',
            'capacity_weight' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'capacity' => $request->capacity,
            'capacity_weight' => $request->capacity_weight,
            'status' => $request->status,
        ];

        $village = Gadi::where('id', $request->id)
            ->update($data);

        return redirect()->route('admin.transport-vehicle')->with('success', 'Transport vehicle Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $village = Gadi::where('id', $id)->firstorfail()->delete();
        return redirect()->route('admin.transport-vehicle')->with('success', 'Transport Vehicle Removed Successfully!');
    }
}
