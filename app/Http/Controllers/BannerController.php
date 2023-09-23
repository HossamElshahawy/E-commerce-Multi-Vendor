<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BannerController extends Controller
{

    public function index()
    {
        $banners = Banner::orderBy('id','DESC')->get();
        return view('backend.banners.index',compact('banners'));
    }


    public function create()
    {
        return view('backend.banners.create');

    }


    public function store(Request $request)
    {

        $this->validate($request,[
            'title'=>'string|required',
            'slug'=>'string|required|unique:banners,slug',
            'summary'=>'string|nullable',
            'photo'=>'required',
            'condition'=>'nullable|in:banner,promo',
            'status'=>'nullable|in:active,inactive',
        ]);

        $data = $request->all();

        $status = Banner::create($data);
        if ($status){
//            return redirect()->route('banner.index');
            return redirect()->back()->with('success','banner added successfuly');
        }
        return redirect()->back()->with('error','there is error');


    }


    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        if ($banner)
        {
            return view('backend.banners.edit',compact('banner'));
        }else{
            return redirect()->back()->with('error','Data Not Found');
        }
    }


    public function update(Request $request, string $id)
    {
        $banner = Banner::findOrFail($id);
        if ($banner) {

            $this->validate($request, [
                'title' => 'string|required',
                'slug'=>'string|exists:banners,slug',
                'summary' => 'string|nullable',
                'photo' => 'required',
                'condition' => 'nullable|in:banner,promo',
                'status' => 'nullable|in:active,inactive',
            ]);

            $data = $request->all();
            $status = $banner->fill($data)->save();
            if ($status) {
                return redirect()->route('banner.index')->with('success', 'banner Updated successfuly');
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
        $banner = Banner::findOrFail($id);
        if ($banner)
        {
            $status = $banner->delete();
            if ($status)
            {
                return redirect()->route('banner.index')->with('success', 'banner deleted successfuly');
            }else
            {
                return redirect()->back()->with('error', 'there is error');
            }
        }
        return redirect()->back()->with('error', 'Data Not Found');

    }

    public function bannerStatus(Request $request)
    {
        if ($request->mode=='true')
        {
            DB::table('banners')->where('id',$request->id)->update(['status'=>'active']);
        }
        else
        {
            DB::table('banners')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfuly updated','status'=>true]);
    }
}
