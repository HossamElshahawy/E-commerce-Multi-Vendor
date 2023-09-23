<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $banners = Banner::where(['status'=>'active','condition'=>'banner'])->orderBy('id','DESC')->limit(3)->get();
        $categories = Category::where(['status'=>'active','is_parent'=>1])->orderBy('id','DESC')->limit(3)->get();
        $new_products = Product::where(['status'=>'active','condition'=>'new'])->orderBy('id','DESC')->limit(10)->get();

        return view('frontend.index',compact('banners','categories','new_products'));
    }

//    public function productCategory(Request $request ,$slug)
//    {
//
//        $categories = Category::with('products')->where('slug',$slug)->first();
//
//       $sort= '';
//       if ($request->sort !=null)
//       {
//           $sort = $request->sort;
//       }
//       if ($categories==null)
//       {
//           abort(404);
//       }
//       else{
//           if ($sort == 'priceDesc')
//           {
//               $product = Product::where(['status'=>'active','category_id'=>$categories->id])->orderBy('offer_price','DESC')->paginate(12);
//           }elseif($sort == 'priceAsc'){
//               $product = Product::where(['status'=>'active','category_id'=>$categories->id])->orderBy('offer_price','ASC')->paginate(12);
//           }elseif($sort == 'discAsc'){
//               $product = Product::where(['status'=>'active','category_id'=>$categories->id])->orderBy('price','ASC')->paginate(12);
//           }elseif($sort == 'discDesc'){
//               $product = Product::where(['status'=>'active','category_id'=>$categories->id])->orderBy('price','DESC')->paginate(12);
//           }elseif($sort == 'titleAsc'){
//               $product = Product::where(['status'=>'active','category_id'=>$categories->id])->orderBy('title','ASC')->paginate(12);
//           }elseif($sort == 'titleDesc'){
//               $product = Product::where(['status'=>'active','category_id'=>$categories->id])->orderBy('title','DESC')->paginate(12);
//           }else{
//               $product = Product::where(['status'=>'active','category_id'=>$categories->id])->paginate(12);
//
//           }
//       }
//
//
//
//        $route = 'product/category';
//        return view('frontend.pages.product.product-category',compact('categories','route','product'));
//    }

    public function productCategory($slug)
    {

        $categories = Category::with('products')->where('slug',$slug)->first();
        return view('frontend.pages.product.product-category',compact('categories'));
    }

    public function productDetails($slug)
    {
        $product = Product::with('relatedProducts')->where('slug',$slug)->first();
        if ($product)
        {
            return view('frontend.pages.product.product-details',compact('product'));
        }
        else
        {
            return 'Product Detail Not Found';
        }
    }


}
