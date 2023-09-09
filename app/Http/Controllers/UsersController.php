<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::orderBy('id','DESC')->get();
        return view('backend.users.index',compact('users'));
    }

    public function create()
    {
        return view('backend.users.create');

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'username'=>'string|required',
            'full_name'=>'string|required',
            'photo'=>'required',
            'role'=>'nullable|in:admin,customer,vendor',
            'status'=>'nullable|in:active,inactive',
            'email'=>'email|required|unique:users,email',
            'password'=>'min:4|required'
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $status = User::create($data);
        if ($status){
            return redirect()->back()->with('success','Data added Successfully');
        }
        return redirect()->back()->with('error','Data Deleted');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        if ($user)
        {
            return view('backend.users.edit',compact('user'));
        }else{
            return redirect()->back()->with('error','Data Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        if ($user) {

            $this->validate($request,[
                'username'=>'string|required',
                'full_name'=>'string|required',
                'photo'=>'required',
                'role'=>'nullable|in:admin,customer,vendor',
                'status'=>'nullable|in:active,inactive',
                'email' => 'required|email|unique:users,email,' . $user->id

            ]);

            $data = $request->all();

            $status = $user->fill($data)->save();
            if ($status) {
                return redirect()->route('user.index')->with('success', 'User Updated successfuly');
            } else {
                return redirect()->back()->with('error', 'there is error');
            }
        }
        else
        {
            return redirect()->back()->with('error','Data Not Found');
        }
    }


    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user)
        {
            $status = $user->delete();
            if ($status)
            {
                return redirect()->route('user.index')->with('success', 'User deleted successfuly');
            }else
            {
                return redirect()->back()->with('error', 'there is error');
            }
        }
        return redirect()->back()->with('error', 'Data Not Found');
    }

    public function userStatus(Request $request)
    {
        if ($request->mode=='true')
        {
            DB::table('users')->where('id',$request->id)->update(['status'=>'active']);
        }
        else
        {
            DB::table('users')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfuly updated','status'=>true]);
    }

}
