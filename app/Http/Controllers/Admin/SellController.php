<?php

namespace App\Http\Controllers\admin;

use App\Village;
use App\City;
use App\Coldstore;
use App\Sell;
use DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SellController extends Controller
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
        return view('admin.sell.index');
    }
 
    /**
     * Get User List From DB  For Datatables
     *
     * @return \Illuminate\Http\Response
    */
    public function getSells()
    {
        $villages = Sell::select('sells.*','cities.name as cityname','villages.name as villagename','coldstores.name as storename')->leftjoin('cities', 'sells.city_id_FK', 'cities.id')->leftjoin('villages', 'sells.village_id_FK', 'villages.id')->leftjoin('coldstores', 'sells.coldstore_id_FK', 'coldstores.id')->latest()->get();

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
        $data = City::where('state_id', 21)->get();
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
            'stock_name' => 'required|min:1|max:255',
            'weigth' => 'required|min:1|max:255',
            'type' => 'required|min:1|max:255',
            'cityname' => 'required|min:1|max:255',
            'villagename' => 'required|min:1|max:255',
            'amount' => 'required|min:1|max:255',
        ]);

        $coldstore = Coldstore::create([
            'name' => $request->name,
            'stock_name' => $request->stock_name,
            'weigth' => $request->weigth,
            'type' => $request->type,
            'city_id_FK' => $request->cityname,
            'village_id_FK' => $request->villagename,
            'amount' => $request->amount,
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
        $cities = City::where('state_id', 21)->get();
        $village = Village::orderBy('id', 'DESC')->get();
        $coldstore = Coldstore::where(['id'=>$id])->first();

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
            'stock_name' => 'required|min:1|max:255',
            'weigth' => 'required|min:1|max:255',
            'type' => 'required|min:1|max:255',
            'cityname' => 'required|min:1|max:255',
            'villagename' => 'required|min:1|max:255',
            'amount' => 'required|min:1|max:255',
        ]);

        $data = [
            'name' => $request->name,
            'stock_name' => $request->stock_name,
            'weigth' => $request->weigth,
            'type' => $request->type,
            'city_id_FK' => $request->cityname,
            'village_id_FK' => $request->villagename,
            'amount' => $request->amount,
        ];

        // if (!empty($request->password)) {
        //     $data['password'] = Hash::make($request->password);
        // }
        
        $village = Coldstore::where('id', $request->id)
            ->update($data);

        return redirect()->route('admin.cold-store')->with('success', 'Cold-Store Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $village = Coldstore::where('id', $id)->firstorfail()->delete();
        return redirect()->route('admin.cold-store')->with('success', 'Cold-Store Removed Successfully!');
    }
}
