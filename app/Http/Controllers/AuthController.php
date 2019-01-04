<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class AuthController extends Controller
{
    public function showLogin(){
      return view("auth.login");
    }

    public function login(Request $request){

      $this->validate($request, [
        "email" => "required",
        "password" => "required"
      ]);

      if (Auth::attempt(['email' => $request->email ,'password' => $request->password])){
        return redirect()->route("rooms.index");
      }
      return redirect()->back()->withErrors(['message' => 'Email or password is incorrect']);

    }

    public function showSignup(){
      return view("auth.signup");
    }

    public function signup(Request $request){

        $data = $request->validate([
        "name" => "required",
        "email" => "required|unique:users|email",
        "password" => "required"
      ]);

      $user = User::create($data);

      Auth::login($user);
      return redirect()->route("rooms.index");


    }

    public function logout(){

      Auth::logout();
      return redirect()->route('login.show');

    }
}
