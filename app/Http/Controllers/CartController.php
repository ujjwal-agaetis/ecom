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
        //dd($request->all());
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
        // $rowId = '8cbf215baa3b757e910e5305ab981172';
        // Cart::remove($rowId);
        echo 'Cart Count: '.Cart::count(); // get total cart count
        // Cart::add('293ad', 'Product 1', 1, 9.99); // add to cart
        //Cart::restore('username');
        dd(Cart::content()); // get cart content
        //return view('cart/index');
    }

    
}