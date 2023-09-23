<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::orderBy('id','DESC')->get();
        return view('backend.coupons.index',compact('coupons'));
    }


    public function create()
    {
        return view('backend.coupons.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'code'=>'required|min:2',
            'value'=>'required|numeric',
            'status'=>'required|in:active,inactive',
            'type'=>'required|in:percent,fixed',
        ]);
        $data = $request->all();
        $status = Coupon::create($data);
        if ($status){
            return redirect()->route('coupon.index')->with('success','Coupon added successfuly');
        }
        return redirect()->back()->with('error','there is error');
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        if ($coupon)
        {
            return view('backend.coupons.edit',compact('coupon'));
        }else{
            return redirect()->back()->with('error','Data Not Found');
        }

    }


    public function update(Request $request, string $id)
    {
        $coupon = Coupon::findOrFail($id);
        if ($coupon) {

            $this->validate($request, [
                'code'=>'required|min:2',
                'value'=>'required|numeric',
                'type'=>'required|in:percent,fixed',
            ]);

            $data = $request->all();
            $status = $coupon->fill($data)->save();
            if ($status) {
                return redirect()->route('coupon.index')->with('success', 'Coupon Updated successfuly');
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
        $coupon = Coupon::findOrFail($id);
        if ($coupon)
        {
            $status = $coupon->delete();
            if ($status)
            {
                return redirect()->route('coupon.index')->with('success', 'coupon deleted successfuly');
            }else
            {
                return redirect()->back()->with('error', 'there is error');
            }
        }
        return redirect()->back()->with('error', 'Data Not Found');
    }

    public function couponStatus(Request $request)
    {
        if ($request->mode=='true')
        {
            DB::table('coupons')->where('id',$request->id)->update(['status'=>'active']);
        }
        else
        {
            DB::table('coupons')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfuly updated','status'=>true]);
    }

}
