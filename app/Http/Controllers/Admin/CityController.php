<?php

namespace App\Http\Controllers\Admin;

use App\City;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
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
        $users = User::latest()->get();
        
        return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('edit', function($row){

                   $btn = '<a href="'.url('admin/edit-user/').'/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';

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
        return view('admin.users.create');   
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
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:3|confirmed',
            'city' => 'required|min:3|max:255',
            'country' => 'required|min:3|max:255',
            'postcode' => 'required|min:5|max:7',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile_number' => $request->mobile_number,
            'city' => $request->city,
            'country' => $request->country,
            'postcode' => $request->postcode,
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
        $user = User::where(['id'=>$id])->first();
        
        return view('admin.users.edit', [ 'user' => $user]);
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
            'email' => 'required|email|max:255|unique:users,email, '. $request->id . ',id',
            'city' => 'required|min:3|max:255',
            'country' => 'required|min:3|max:255',
            'postcode' => 'required|min:5|max:7',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'city' => $request->city,
            'country' => $request->country,
            'postcode' => $request->postcode,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
        
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
