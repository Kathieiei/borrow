<?php

namespace App\Http\Controllers\User;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        $items = Item::Where('status',0);
        if (!empty($request->get('search'))) {
            $items->Where('title','like','%'.$request->get('search').'%');
        }
        $items = $items->get();

        $cout_item_in_cart = Cart::Where('user_id',auth()->user()->id)->count();
        return view('user.home',compact('items','cout_item_in_cart'));
    }
}
