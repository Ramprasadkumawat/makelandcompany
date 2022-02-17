<?php

namespace App\Http\Controllers\Admin;

use App\Village;
use App\City;
use DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VillageController extends Controller
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
        return view('admin.villages.index');
    }
 
    /**
     * Get User List From DB  For Datatables
     *
     * @return \Illuminate\Http\Response
    */
    public function getVillagesData()
    {
        $villages = Village::select('villages.*','cities.name as cityname')->leftjoin('cities', 'villages.city_id_FK', 'cities.id')->latest()->get();
        
        return Datatables::of($villages)
                ->addIndexColumn()
                ->addColumn('edit', function($row){

                   $btn = '<a href="'.url('admin/edit-village/').'/'.base64_encode($row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';

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
        $data = City::where('state_id', 21)->get();
        return view('admin.villages.create',compact('data'));   
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
            'cityname' => 'required|min:1|max:255',
        ]);

        $village = Village::create([
            'name' => $request->name,
            'city_id_FK' => $request->cityname,
        ]);

        return redirect()->route('admin.villages')->with('success', 'Village Added Successfully!');
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
        $cities = City::where('state_id', 21)->get();
        $village = Village::where(['id'=>$id])->first();
        
        return view('admin.villages.edit', [ 'village' => $village],compact('cities'));
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
            'cityname' => 'required|min:1|max:255',
        ]);

        $data = [
            'name' => $request->name,
            'city_id_FK' => $request->cityname,
        ];

        // if (!empty($request->password)) {
        //     $data['password'] = Hash::make($request->password);
        // }
        
        $village = Village::where('id', $request->id)
            ->update($data);

        return redirect()->route('admin.villages')->with('success', 'Village Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $village = Village::where('id', $id)->firstorfail()->delete();
        return redirect()->route('admin.villages')->with('success', 'Village Removed Successfully!');
    }
}
