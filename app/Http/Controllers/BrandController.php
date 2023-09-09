<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::orderBy('id','DESC')->get();
        return view('backend.brands.index',compact('brands'));

    }

    public function create()
    {
        return view('backend.brands.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'string|required',
            'photo'=>'required',
            'status'=>'nullable|in:active,inactive',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Brand::where('slug',$slug)->count();
        if ($slug_count>0)
        {
            $slug .= time().'-'.$slug;
        }
        $data['slug']=$slug;

        $status = Brand::create($data);
        if ($status){
//            return redirect()->route('banner.index');
            return redirect()->back()->with('success','brand added successfuly');
        }
        return redirect()->back()->with('error','there is error');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        if ($brand)
        {
            return view('backend.brands.edit',compact('brand'));
        }else{
            return redirect()->back()->with('error','Data Not Found');
        }
    }

    public function update(Request $request, string $id)
    {
        $brand = Brand::findOrFail($id);
        if ($brand) {

            $this->validate($request, [
                'title' => 'string|required',
                'photo' => 'required',
                'status' => 'nullable|in:active,inactive',
            ]);

            $data = $request->all();
            $slug = Str::slug($request->input('title'));
            $slug_count = Brand::where('slug', $slug)->count();
            if ($slug_count > 0) {
                $slug .= time() . '-' . $slug;
            }
            $data['slug'] = $slug;

            $status = $brand->fill($data)->save();
            if ($status) {
                return redirect()->route('brand.index')->with('success', 'brand added successfuly');
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
        $brand = Brand::findOrFail($id);
        if ($brand)
        {
            $status = $brand->delete();
            if ($status)
            {
                return redirect()->route('brand.index')->with('success', 'brand deleted successfuly');
            }else
            {
                return redirect()->back()->with('error', 'there is error');
            }
        }
        return redirect()->back()->with('error', 'Data Not Found');
    }


    public function brandStatus(Request $request)
    {
        if ($request->mode=='true')
        {
            DB::table('brands')->where('id',$request->id)->update(['status'=>'active']);
        }
        else
        {
            DB::table('brands')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfuly updated','status'=>true]);
    }

}
