<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function userAuth()
    {
        return view('frontend.auth.auth');
    }

    public function userLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|exists:users,email',
            'password' => 'required|string|exists:users,password',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])) {
            Session::put('user', $request->email);

            if (Session::get('url.intended')) {
                return Redirect::to(Session::get('url.intended'));
            } else {
                return redirect()->route('home.frontend')->with('success', 'Successfully Login');
            }
        } else {
            return back()->with('error', 'Invalid Email & password')->withInput();
        }
    }

    public function userRegister(Request $request)
    {
        $this->validate($request,[
           'username'=>'required|string',
           'full_name'=>'required|string',
            'email'=>'email|required|unique:users,email',
            'password'=>'min:4|required|confirmed'
        ]);
        $data = $request->all();
        $check = $this->create($data);
        Session::put('user',$data['email']);
        Auth::login($check);
        if ($check)
        {
            return redirect()->route('home.frontend');
        }else
        {
            return back();
        }

    }

    private function create(array $data)
    {
        return User::create([
            'username'=>$data['username'],
            'full_name'=>$data['full_name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
        ]);

    }

    public function userLogout()
    {
        Session::forget('user');
        Auth::logout();
        return \redirect()->route('home.frontend')->with('success','Successfully Logout');
    }
}
