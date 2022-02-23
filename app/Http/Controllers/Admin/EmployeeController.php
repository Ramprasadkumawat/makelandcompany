<?php

namespace App\Http\Controllers\admin;

use App\Village;
use App\City;
use App\Mazdur;
use App\Gadi;
use DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
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
        return view('admin.employees.index');
    }
 
    /**
     * Get User List From DB  For Datatables
     *
     * @return \Illuminate\Http\Response
    */
    public function getEmployeesData()
    {
        $employees = Mazdur::latest()->get();
        return Datatables::of($employees)
                ->addIndexColumn()
                
                ->addColumn('edit', function($row){

                   $btn = '<a href="'.url('admin/edit-employees/').'/'.base64_encode($row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';

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
        return view('admin.employees.create');   
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
            'per_round_payment' => 'required',
            'status' => 'required',
        ]);

        $transportvehicle = Mazdur::create([
            'name' => $request->name,
            'per_round_payment' => $request->per_round_payment,
            'status' => $request->status,
            
        ]);

        return redirect()->route('admin.employees')->with('success', 'Employee Added Successfully!');
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
        $employees = Mazdur::where(['id'=>$id])->first();

        return view('admin.employees.edit', [ 'employees' => $employees]);
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
            'per_round_payment' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'per_round_payment' => $request->per_round_payment,
            'status' => $request->status,
        ];

        $village = Mazdur::where('id', $request->id)
            ->update($data);

        return redirect()->route('admin.employees')->with('success', 'Employee Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $village = Mazdur::where('id', $id)->firstorfail()->delete();
        return redirect()->route('admin.employees')->with('success', 'Employee Removed Successfully!');
    }
}
