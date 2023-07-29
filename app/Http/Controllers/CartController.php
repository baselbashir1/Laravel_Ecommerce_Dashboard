<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::all();
        if (app()->getLocale() == 'en') return view('pages.app.ecommerce.carts', ['title' => __('trans.carts')], ['cartItems' => $cartItems]);
        if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.carts', ['title' => __('trans.carts')], ['cartItems' => $cartItems]);
    }

    public function edit($id)
    {
        $cartItem = CartItem::where('id', $id)->first();
        $products = Product::all();
        if (app()->getLocale() == 'en') return view('pages.app.ecommerce.edit-cart', ['title' => __('trans.edit_cart')], ['cartItem' => $cartItem, 'products' => $products]);
        if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.edit-cart', ['title' => __('trans.edit_cart')], ['cartItem' => $cartItem, 'products' => $products]);
    }

    public function update(Request $request, $id)
    {
        $formFields = $request->all();

        $cartItem = CartItem::where('id', $id)->first();
        $cartItem->update($formFields);

        return redirect('/carts');
    }

    public function destroy($id)
    {
        CartItem::where('id', $id)->first()->delete();
        return redirect('/carts');
    }
}
