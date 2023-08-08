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

    public function place_order(Request $request)
    {
        $cart_data1 = Cart::content();
        foreach ($cart_data1 as $key => $value) {
            
            $id=$value->id;
            $row_id=$value->rowId;
            $qty=$value->qty;

            // Get product quantity
            $product = Product::where('id', '=', $id)->get();
            $current_qty = $product[0]->quantity;
            $new_qty= $current_qty - $qty;

            // Update product quantity
            $product = Product::find($product[0]->id);
            $product->quantity = $new_qty;
            $product->save();

            // Remove cart item
            Cart::remove($row_id);
        }
         return true;
    }

    }




    
