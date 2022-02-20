<?php

namespace App\Http\Controllers\Admin;

use App\PaymentType;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PaymentTypeController extends Controller
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
        return view('admin.payment-type.index');
    }
 
    /**
     * Get PaymentType List From DB  For Datatables
     *
     * @return \Illuminate\Http\Response
    */
    public function getPaymentTypesData()
    {
        $users = PaymentType::latest()->get();
        
        return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('edit', function($row){

                   $btn = '<a href="'.url('admin/edit-payment-type/').'/'.base64_encode($row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';

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
        return view('admin.payment-type.create');   
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

        $user = PaymentType::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.payment-type')->with('success', 'PaymentType Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('admin.payment-type.edit');  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);

        $paymentType = PaymentType::where(['id'=>$id])->first();

        return view('admin.payment-type.edit', [ 'paymentType' => $paymentType]);
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
        
        $user = PaymentType::where('id', $request->id)
            ->update($data);

        return redirect()->route('admin.payment-type')->with('success', 'PaymentType Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $user = PaymentType::where('id', $id)->firstorfail()->delete();
        return redirect()->route('admin.payment-type')->with('success', 'PaymentType Removed Successfully!');
    }
}
