<?php

namespace App\Http\Controllers\admin;

use App\Village;
use App\City;
use App\Coldstore;
use DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ColdStoreController extends Controller
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
        return view('admin.cold-store.index');
    }
 
    /**
     * Get User List From DB  For Datatables
     *
     * @return \Illuminate\Http\Response
    */
    public function getColdStoreData()
    {
        $villages = Coldstore::select('coldstores.*','cities.name as cityname','villages.name as villagename')->leftjoin('cities', 'coldstores.city_id_FK', 'cities.id')->leftjoin('villages', 'coldstores.village_id_FK', 'villages.id')->latest()->get();

        return Datatables::of($villages)
                ->addIndexColumn()
                
                ->addColumn('edit', function($row){

                   $btn = '<a href="'.url('admin/edit-cold-store/').'/'.base64_encode($row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';

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
        $data = City::where('state_id', 1)->get();
        $village = Village::orderBy('id', 'DESC')->get();
        return view('admin.cold-store.create',compact('data','village'));   
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
            'city_id' => 'required',
            'village_id' => 'required',
            'status' => 'required',
        ]);

        $coldstore = Coldstore::create([
            'name' => $request->name,
            'city_id_FK' => $request->city_id,
            'village_id_FK' => $request->village_id,
            'status' => $request->status,
            
        ]);

        return redirect()->route('admin.cold-store')->with('success', 'Cold-Store Added Successfully!');
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
        $cities = City::where('state_id', 1)->get();
        $coldstore = Coldstore::where(['id'=>$id])->first();
        $village = Village::where(['city_id_FK'=>$coldstore->city_id_FK])->orderBy('id', 'DESC')->get();
        
        return view('admin.cold-store.edit', [ 'coldstore' => $coldstore],compact('cities','village'));
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
            'city_id' => 'required',
            'village_id' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'city_id_FK' => $request->city_id,
            'village_id_FK' => $request->village_id,
            'status' => $request->status,
        ];

        $village = Coldstore::where('id', $request->id)
            ->update($data);

        return redirect()->route('admin.cold-store')->with('success', 'Cold tore Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $village = Coldstore::where('id', $id)->firstorfail()->delete();
        return redirect()->route('admin.cold-store')->with('success', 'Cold Store Removed Successfully!');
    }
}
