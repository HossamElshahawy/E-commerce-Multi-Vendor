<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    public function index()
    {
    $user = \auth()->user();
    return view('frontend.user.dashboard',compact('user'));
    }

    public function userOrder()
    {
        $user = \auth()->user();
        return view('frontend.user.order',compact('user'));
    }

    public function userAddress()
    {
        $user = \auth()->user();
        return view('frontend.user.address',compact('user'));
    }

    public function userAccount()
    {
        $user = \auth()->user();
        return view('frontend.user.account_details',compact('user'));
    }
    public function billingAddress(Request $request,$id)
    {
        $user = User::where('id',$id)->update([
            'address'=>$request->address,
            'country'=>$request->country,
            'postcode'=>$request->postcode,
            'state'=>$request->state,
            'city'=>$request->city

        ]);
        if ($user)
        {
            return back()->with('success','updated Billing Address Successfully');
        }else{
            return back()->with('error','there is error in data');
        }
    }

    public function shippingAddress(Request $request,$id)
    {
        $user = User::where('id',$id)->update([
            'saddress'=>$request->saddress,
            'scountry'=>$request->scountry,
            'spostcode'=>$request->spostcode,
            'sstate'=>$request->sstate,
            'scity'=>$request->scity

        ]);
        if ($user)
        {
            return back()->with('success','updated Shipping Address Successfully');
        }else{
            return back()->with('error','there is error in data');
        }
    }

    public function updateAccount(Request $request,$id)
    {
        $this->validate($request,[
            'username'=>'string|nullable',
            'full_name'=>'required|string',
            'newpassword'=>'nullable|min:4',
            'current_password'=>'nullable|min:4',
            'phone'=>'min:8|nullable',
        ]);



        $hashPassword = Auth::user()->password;
        if ($request->current_password == null && $request->newpassword == null){
            User::where('id',$id)->update([
                'full_name'=>$request->full_name,
                'username'=>$request->username,
                'phone'=>$request->phone,
            ]);
        }else{
            if (Hash::check($request->current_password,$hashPassword)) {
                if (!Hash::check($request->newpassword, $hashPassword)) {
                    User::where('id',$id)->update([
                        'full_name'=>$request->full_name,
                        'username'=>$request->username,
                        'phone'=>$request->phone,
                        'password'=>Hash::make($request->newpassword)
                    ]);
                    return redirect()->back()->with('success', 'Account Success Updated');
                } else {
                    return redirect()->back()->with('error', 'New Password can not be same with old Password');
                }
            }
            else{
                return redirect()->back()->with('error','Old Password Does Not Match');
            }
        }
    }
}
