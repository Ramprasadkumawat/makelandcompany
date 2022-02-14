<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use App\User;

  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
      
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            
            $finduser = User::where('email', $user->email)
               // ->where('login_type', 2)
                ->first();
     
            if ($finduser) {
     
                Auth::login($finduser);
                return redirect('/home');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id'=> $user->id,
                    'login_type'=>1,
                    'password' => encrypt('123456')
                ]);
    
                Auth::login($newUser);
     
                return redirect('/home');
            }
        } catch (Exception $e) {
            dd($e);
            dd($e->getMessage());
        }
    }
}