<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
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
        } else {
            $filteredResults = Cart::where('session_id', $session_id)->get();
        }
        return view('cart/index', ['cart' => $filteredResults]);
    }
    public function add_product_to_cart(Request $request)
    {
        $session_id = $request->session()->getId();  // Get the session ID
        session(['prev_session_id' => $session_id]);
        $session_id = session('prev_session_id');
        $userId = Auth::id();
        $id = $request->product_id;
        $product = Product::findOrFail($id);
        $data = [
            "product_id" => $product->id,
            "item_name" => $product->name,
            "quantity" => $request->quantity,
            "price" => $product->price,
            "session_id" => $session_id,
            "user_id" => $userId
        ];
        Cart::create($data);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function remove(Request $request)
    {
        if ($request->id) {
            $record = Cart::find($request->id);
            $record->delete();
            session()->flash('success', 'Product removed successfully');
        }
    }
    
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
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
        // Authenticate form
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            // Return validation errors
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $userId = Auth::id();
        $data = [
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "email" => $request->email,
            "address1" => $request->address1,
            "address2" => $request->address2,
            "city" => $request->city,
            "state" => $request->state,
            "zip" => $request->zip,
            "user_id" => $userId
        ];
        $order_data = Order::create($data);
        $order_id = $order_data->id;
        // Cart data movement to Order_item table
        $cart_items = cart::where('user_id', $userId)->get();
        //    dd($cart_items->toarray());
        foreach ($cart_items as $key => $cart_item) {
            $order_items = [
                "product_id" => $cart_item->product_id,
                "item_name" => $cart_item->item_name,
                "quantity" => $cart_item->quantity,
                "price" => $cart_item->price,
                "order_id" => $order_id,
            ];
            Orderitem::create($order_items);
            //delete entry from cart table
            $cart_item->delete();
        }
        return true;
    }
}