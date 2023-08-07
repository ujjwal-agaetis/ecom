<?php
namespace App\Http\Controllers;
use Cart;
use Illuminate\Http\Request;
use App\Models\Product;
class CartController extends Controller
{
    public function index()
    {
        $cart_data = Cart::content();
        return view('cart/index', compact('cart_data'));
    }

    public function add_product_to_cart(Request $request)
    {
        $productId = $request->input('product_id');
        $productName = $request->input('product_name');
        $productPrice = $request->input('product_price');
        $quantity = $request->input('quantity');
        Cart::add($productId, $productName, $quantity, $productPrice);
        Cart::restore('ecom');
        return true;
    }

    public function cart_add()
    {  
        echo 'Cart Count: '.Cart::count(); // get total cart count
        dd(Cart::content()); // get cart content
    }

    public function place_order()
    { 
        $cart_data1 = Cart::content();
        foreach ($cart_data1 as $key => $value) {
            $id=$value->id;
            $row_id=$value->rowId;
            $qty=$value->qty;
            $product = Product::where('id', '=', $id)->get();
            $current_qty = $product[0]->quantity;
            $new_qty= $current_qty - $qty;
            //    dd($new_qty);
            $product->update(['quantity' => $new_qty]);
            // dd($product);
            Cart::remove($row_id);
        }
         return true;
    }

    }




    
