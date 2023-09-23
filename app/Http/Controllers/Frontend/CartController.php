<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        return view('frontend.pages.cart.index');
    }


    public function cartStore(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        $product = Product::getProductByCart($product_id);
        $price = $product[0]['offer_price'];

        $result = Cart::instance('shopping')->add($product_id,$product[0]['title'],$product_qty,$price)->associate('App\Models\Product');
        if ($result)
        {
            $response['status']=true;
            $response['product_id']=$product_id;
            $response['total']=Cart::subtotal();
            $response['cart_count']=Cart::instance('shopping')->count();
            $response['message']="Item was added to your cart";

        }
        if($request->ajax())
        {
            $header = view('frontend.layout.header')->render();
            $response['header']=$header;
        }
        return json_encode($response);

    }

    public function cartDelete(Request $request)
    {
        $cart_id = $request->input('cart_id');
        Cart::instance('shopping')->remove($cart_id);

            $response['status']=true;
            $response['message']='Cart Successfully Removed';
            $response['total']=Cart::subtotal();
            $response['cart_count']=Cart::instance('shopping')->count();

        if($request->ajax())
        {
            $header = view('frontend.layout.header')->render();
            $response['header']=$header;
        }
        return json_encode($response);
    }
}
