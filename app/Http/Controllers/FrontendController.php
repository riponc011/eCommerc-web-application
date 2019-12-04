<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Contact;
use App\Cart;
use Carbon\Carbon;
use Mail;
use App\Mail\ContactMessage;

class FrontendController extends Controller
{
    function index(){
        $products = Product::all();
        $categories = Category::all();
        return view('welcome', compact('products', 'categories'));
        // return view('welcome');
    }
    function contact(){
        return view('contact');
    }
    function about(){
        return view('about');
    }
    function productdetails($product_id){
        $single_product_info = Product::find($product_id);
        $related_products = Product::where('id', '!=', $product_id)->where('category_id', $single_product_info->category_id)->get();
        return view('frontend/productdetails', compact('single_product_info', 'related_products'));
    }

    function productsbycategory($category_id){
        $products = Product::where('category_id', $category_id)->get();
        return view('frontend/productsbycategory', compact('products'));
    }
    function contactinsert(Request $request){
        // Contact::insert([
        //     'first_name'=>$request->first_name,
        //     'last_name'=>$request->last_name,
        //     'subject'=>$request->subject,
        //     'message'=>$request->message
        // ]);
        Contact::insert($request->except('_token'));
        $first_name = $request->first_name;
        $message = $request->message;
        Mail::to('riponcb1515@gmail.com')->send(new ContactMessage($first_name, $message));
        
        return back()->with('status', 'Mesasage Sent Successfully');
    }
    
    function addtocart($product_id){
        $ip_address = ($_SERVER['REMOTE_ADDR']);
        if(Cart::where('customer_ip', $ip_address)->where('product_id', $product_id)->exists()){
            Cart::where('customer_ip', $ip_address)->where('product_id', $product_id)->increment('product_quantity', 1);
        }
        else{
            Cart::insert([
                'customer_ip' => $ip_address,
                'product_id' => $product_id,
                'created_at' => Carbon::now()
            ]);
        }
        
        return back();
    }
    function cart(){
        $cart_items = Cart::where('customer_ip', $_SERVER["REMOTE_ADDR"])->get();
        return view('frontend/cart', compact('cart_items'));
    }

    function deletefromcart($cart_id){        
        Cart::find($cart_id)->delete();
        return back();
    }

    function clearcart(){
        Cart::where('customer_ip', $_SERVER["REMOTE_ADDR"])->delete();
        return back();
    }
}
