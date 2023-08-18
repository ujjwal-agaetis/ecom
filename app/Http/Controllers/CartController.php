<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
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

    public function storeInSession()
    {
    // Store data in the session
    Session::put('key', 'value');

    // You can store more data
    Session::put('user_id', 123);
    return redirect()->back();
    }

    public function add_product_to_cart(Request $request)
    { 
        // $session_id = Session::getId();
        $session_id = $request->session()->getId(); // Get the session ID
        // dd($session_id);
        $id = $request->product_id;
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++; 
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $request->quantity,
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
        foreach ($cart as $key => $value) {
             $name=$value['name'];
             $quantity=$value['quantity'];
             $price=$value['price'];
             $data = [
                "order_id" => '1',
                "item_name" => $name,
                "quantity" =>$quantity,
                "price" => $price,
            ];
            Cart::create($data);
        }
        // Unset session data
        session()->forget('cart');
        return true;  
    }
}







