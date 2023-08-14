<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
class CartController extends Controller
{
    public function index()
    {
        // $cart = session()->get('cart', []);
        //  dd($cart);
        return view('cart/index');
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
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
    public function place_order(Request $request)
    {
        $cart = session()->get('cart', []);
        //  dd($cart);
        foreach ($cart as $key => $value) {
             $name=$value['name'];
             $quantity=$value['quantity'];
             $price=$value['price'];
             $data = [
                "order_id" => '1',
                "item_name" => $value['name'],
                "quantity" =>$value['quantity'] ,
                "price" => $value['price'],
            ];
            Cart::create($data);
        }
        // Unset session data
        session()->forget('cart');
        return true;  
    }
}







