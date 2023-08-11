<?php
namespace App\Http\Controllers;
use Cart;
use Illuminate\Http\Request;
use App\Models\Product;
class CartController extends Controller
{
    public function index()
    {
        // $cart = session()->get('cart', []);
        //  dd($cart);
        $cart_data = Cart::content();
        return view('cart/index', compact('cart_data'));
    }

    public function add_product_to_cart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
            
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                // "image" => $product->image
            ];
           
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            // dd($cart);
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
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




    
