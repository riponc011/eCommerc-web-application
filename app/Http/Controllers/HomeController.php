<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_users = User::all();
        return view('home', compact('all_users'));
    }
    public function contactmessageview(){
        $contactmessages = Contact::all();
        return view('contact/view', compact('contactmessages'));
    }
    function changemenustatus($category_id){
        $category_info = Category::find($category_id);
        if($category_info->menu_status == 0){
            $category_info->menu_status = true;
        }else{
            $category_info->menu_status= false;
        }
        $category_info->save();
        return back();
    }
}
