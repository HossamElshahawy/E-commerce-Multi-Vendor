<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('id','DESC')->get();
        return view('backend.products.index',compact('products'));
    }


    public function create()
    {
        return view('backend.products.create');

    }


    public function store(Request $request)
    {

        $this->validate($request,[

         'title'=>'string|required',
         'summary'=>'string|required',
         'description'=>'string|nullable',
        'stock'=>'nullable|numeric',
        'size'=>'nullable',
        'brand_id'=>'required',
        'category_id'=>'required|exists:categories,id',
        'child_category_id'=>'nullable|exists:categories,id',
        'photo'=>'required',
        'price'=>'nullable|numeric',
        'offer_price'=>'nullable|numeric',
        'discount'=>'nullable|numeric',
        'condition'=>'nullable',
        'vendor_id'=>'required',
        'status'=>'nullable|in:active,inactive',
        ]);


        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Product::where('slug',$slug)->count();
        if ($slug_count>0)
        {
            $slug .= time().'-'.$slug;
        }
        $data['slug']=$slug;

        $data['offer_price'] = ($request->price-(($request->price*$request->discount)/100));

        $status = Product::create($data);
        if ($status){
//            return redirect()->route('banner.index');
            return redirect()->route('product.index')->with('success','Product added successfuly');
        }
        return redirect()->back()->with('error','there is error');

    }


    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product)
        {
            return view('backend.products.view',compact('product'));
        }else{
            return redirect()->back()->with('error','Data Not Found');
        }
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        if ($product)
        {
            return view('backend.products.edit',compact('product'));
        }else{
            return redirect()->back()->with('error','Data Not Found');
        }
    }


    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        if ($product) {
            $this->validate($request,[

                'title'=>'string|required',
                'summary'=>'string|required',
                'description'=>'string|nullable',
                'stock'=>'nullable|numeric',
                'size'=>'nullable',
                'brand_id'=>'required',
                'category_id'=>'required|exists:categories,id',
                'child_category_id'=>'nullable|exists:categories,id',
                'photo'=>'required',
                'price'=>'nullable|numeric',
                'offer_price'=>'nullable|numeric',
                'discount'=>'nullable|numeric',
                'condition'=>'nullable',
                'vendor_id'=>'required',
                'status'=>'nullable|in:active,inactive',
            ]);

            $data = $request->all();

            $data['offer_price'] = ($request->price-(($request->price*$request->discount)/100));

            $status = $product->fill($data)->save();
            if ($status) {
                return redirect()->route('product.index')->with('success', 'product added successfuly');
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
        $product = Product::findOrFail($id);
        if ($product)
        {
            $status = $product->delete();
            if ($status)
            {
                return redirect()->route('product.index')->with('success', 'Product deleted successfuly');
            }else
            {
                return redirect()->back()->with('error', 'there is error');
            }
        }
        return redirect()->back()->with('error', 'Data Not Found');

    }

    public function productStatus(Request $request)
    {
        if ($request->mode=='true')
        {
            DB::table('products')->where('id',$request->id)->update(['status'=>'active']);
        }
        else
        {
            DB::table('products')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfuly updated','status'=>true]);
    }

    public function getChildByParentID(Request $request,$id)
    {
        return dd($id);
    }
}
