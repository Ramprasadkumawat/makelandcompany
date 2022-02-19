<?php

namespace App\Http\Controllers\Admin;

use App\Bank;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class BankController extends Controller
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
        return view('admin.banks.index');
    }
 
    /**
     * Get Bank List From DB  For Datatables
     *
     * @return \Illuminate\Http\Response
    */
    public function getBanksData()
    {
        $users = Bank::latest()->get();
        
        return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('edit', function($row){

                   $btn = '<a href="'.url('admin/edit-bank/').'/'.base64_encode($row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';

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
        return view('admin.banks.create');   
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
            'status' => 'required',
        ]);

        $user = Bank::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.banks')->with('success', 'Bank Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('admin.banks.edit');  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);

        $bank = Bank::where(['id'=>$id])->first();

        return view('admin.banks.edit', [ 'bank' => $bank]);
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
            'status' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'status' => $request->status,
        ];
        
        $user = Bank::where('id', $request->id)
            ->update($data);

        return redirect()->route('admin.banks')->with('success', 'Bank Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $user = Bank::where('id', $id)->firstorfail()->delete();
        return redirect()->route('admin.banks')->with('success', 'Bank Removed Successfully!');
    }
}
