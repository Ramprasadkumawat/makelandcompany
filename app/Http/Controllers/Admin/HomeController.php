<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\User;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userCount = User::count();
        $data = [
            'userCount' => $userCount,
        ];
        
        return view('admin.home', ['data' => $data]);
    }

    /**
     * Show the User Profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile(Request $req)
    {
        $user = Admin::where('id',  Auth::user()->id)->first();
        
        return view('admin.admin-profile', ['user' => $user]);
    }

     /**
     * Update the User Profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateProfile(Request $request)
    {
        
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users,email, '. Auth::user()->id . ',id',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
        ];
        
        $admin = Admin::where('id', Auth::user()->id)
            ->update($data);

        return redirect()->route('admin.profile')->with('success', 'Admin Updated Successfully!');
    }    
    
     /**
     * Show Change password form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePassword(Request $req)
    {
        return view('admin.change-password');
    }    

     /**
     * Show Change password form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updatePassword(Request $request)
    {
        $request_data = $request->All();
        $request->validate([
            'current-password' => 'required',
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password'
        ]);

        $current_password = Auth::user()->password;
        
        if(Hash::check($request_data['current-password'], $current_password)) {           
            $user_id = Auth::user()->id;  

            $obj_user = Admin::find($user_id);
            $obj_user->password = Hash::make($request_data['password']);
            $obj_user->save(); 

            return redirect()->route('admin.change-password')->with('success', 'Admin Updated Successfully!');
        } else {           
            return redirect()->route('admin.change-password')->with('error', 'Please enter correct current password!');
        }
    }   
}
