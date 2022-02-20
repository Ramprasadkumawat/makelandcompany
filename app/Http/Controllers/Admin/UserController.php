<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Village;
use App\City;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        return view('admin.users.index');
    }
 
    /**
     * Get User List From DB  For Datatables
     *
     * @return \Illuminate\Http\Response
    */
    public function getUsersData()
    {
        $users = User::select('users.*','cities.name as cityname','villages.name as villagename')->leftjoin('cities', 'users.city_id_FK', 'cities.id')->leftjoin('villages', 'users.village_id_FK', 'villages.id')->latest()->get();
        
        return Datatables::of($users)
                ->addIndexColumn()
                ->editColumn('type', function($row){
                    if($row->type == 1) {
                        return "Kisan";
                    } else {
                        return "Merchant";
                    }
                })
                ->addColumn('edit', function($row){

                   $btn = '<a href="'.url('admin/edit-user/').'/'.base64_encode($row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';

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
        return view('admin.users.create',compact('data','village'));   
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
            //'password' => 'required|min:3|confirmed',
            'city_id' => 'required',
            'village_id' => 'required',
            'status' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            //'password' => Hash::make($request->password),
            'mobile_number' => $request->mobile_number,
            'city_id_FK' => $request->city_id,
            'village_id_FK' => $request->village_id,
            'type' => $request->type,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.users')->with('success', 'User Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('admin.users.edit');  
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

        $user = User::where(['id'=>$id])->first();

        $village = Village::where(['city_id_FK'=>$user->city_id_FK])->orderBy('id', 'DESC')->get();

        return view('admin.users.edit', [ 'user' => $user],compact('cities','village'));
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
            'city_id' => 'required',
            'village_id' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'city_id_FK' => $request->city_id,
            'village_id_FK' => $request->village_id,
            'type' => $request->type,
            'status' => $request->status,
        ];

        /* if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        } */
        
        $user = User::where('id', $request->id)
            ->update($data);

        return redirect()->route('admin.users')->with('success', 'User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $user = User::where('id', $id)->firstorfail()->delete();
        return redirect()->route('admin.users')->with('success', 'User Removed Successfully!');
    }
}
