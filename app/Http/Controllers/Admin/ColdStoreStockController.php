<?php

namespace App\Http\Controllers\admin;

use App\Coldstore;
use App\ColdStoreStocks;
use DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ColdStoreStockController extends Controller
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
        return view('admin.coldstore-stock.index');
    }
 
    /**
     * Get User List From DB  For Datatables
     *
     * @return \Illuminate\Http\Response
    */
    public function getColdStoreStocksData()
    {
        $csStocks = ColdStoreStocks::latest()->get();
        return Datatables::of($csStocks)
                ->addIndexColumn()
                ->editColumn('status', function($row) {
                    return ($row->status == 1) ? 'Active' : 'Inactive';
                })
                ->addColumn('coldStoreName', function($row) {
                    return Coldstore::where('id', $row->coldstore_id_FK)->first()->name;
                })
                ->addColumn('edit', function($row){

                   $btn = '<a href="'.url('admin/edit-cold-store-stock/').'/'.base64_encode($row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';

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
        $coldStore = Coldstore::where(['status' => 1])->get();
        return view('admin.coldstore-stock.create', ['coldStore'=>$coldStore]);   
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
            'coldstore_id' => 'required',
            'name' => 'required|min:1|max:255',
            'capacity' => 'required',
            'weight' => 'required',
            'status' => 'required',
        ]);

        ColdStoreStocks::create([
            'coldstore_id_FK' => $request->coldstore_id,
            'name' => $request->name,
            'capacity' => $request->capacity,
            'weight' => $request->weight,
            'status' => $request->status,
            'available_capacity' => $request->capacity,
            'available_weight' => $request->weight,
        ]);

        return redirect()->route('admin.cold-store-storage')->with('success', 'Cold Store Stocks Added Successfully!');
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
        $coldStore = Coldstore::where(['status' => 1])->get();
        $csStock = ColdStoreStocks::where(['id'=>$id])->first();

        return view('admin.coldstore-stock.edit', [ 'csStock' => $csStock, 'coldStore' => $coldStore]);
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
            'coldstore_id' => 'required',
            'name' => 'required|min:1|max:255',
            'capacity' => 'required',
            'weight' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'coldstore_id_FK' => $request->coldstore_id,
            'name' => $request->name,
            'capacity' => $request->capacity,
            'weight' => $request->weight,
            'status' => $request->status,
            'available_capacity' => $request->capacity,
            'available_weight' => $request->weight,
        ];

        $village = ColdStoreStocks::where('id', $request->id)
            ->update($data);

        return redirect()->route('admin.cold-store-storage')->with('success', 'Cold Store Stocks Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $village = ColdStoreStocks::where('id', $id)->firstorfail()->delete();
        return redirect()->route('admin.cold-store-storage')->with('success', 'Cold Store Stocks Removed Successfully!');
    }
}
