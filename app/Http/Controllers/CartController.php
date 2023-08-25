<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
class CartController extends Controller
{
    public function index(Request $request)
    {
        $session_id = session()->getId();
        $userId = Auth::id();
        // info(json_encode($request->session()));
        if (Auth::check()) {
            // The user is logged in...
            $filteredResults = Cart::where('user_id', $userId)->get();
        }else{
            $filteredResults = Cart::where('session_id', $session_id)->get();
        }
        return view('cart/index', ['cart' => $filteredResults]);
    }


    public function add_product_to_cart(Request $request)
    {
        $session_id = $request->session()->getId();  // Get the session ID
        session(['prev_session_id'=>$session_id]);
        $session_id=session('prev_session_id');
        // dd($session_id);
        $userId = Auth::id();
        $id = $request->product_id;
        $product = Product::findOrFail($id);
        $data = [
            "product_id" => $product->id,
            "item_name" => $product->name, 
            "quantity" =>$request->quantity,
            "price" => $product->price,
            "session_id" => $session_id,
            "user_id" => $userId
        ];
        Cart::create($data);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {+
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
            if(isset($cart[$request->id]))
            {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            $record = Cart::find($request->id);
            $record->delete();
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            $update_data = [
                "quantity" => $request->quantity
            ];
            $cart = Cart::findOrFail($request->id);
            $cart->update($update_data);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function place_order(Request $request)
    {
        // dd($request->toarray());
        $userId = Auth::id();
        $data = [
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "email" => $request->email, 
            "address1" =>$request->address1,
            "address2" => $request->address2,
             "city" =>$request->city,
            "state" => $request->state,
            "zip" => $request->zip,
            "user_id" => $userId
        ];
          Order::create($data);
        return true;
       
    }
    
}







