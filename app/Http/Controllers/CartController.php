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
        return view('pages.app.ecommerce.carts', ['title' => 'Carts'], ['cartItems' => $cartItems]);
    }

    public function edit($id)
    {
        $cartItem = CartItem::where('id', $id)->first();
        $products = Product::all();
        return view('pages.app.ecommerce.edit-cart', ['title' => 'Edit Cart'], ['cartItem' => $cartItem, 'products' => $products]);
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
