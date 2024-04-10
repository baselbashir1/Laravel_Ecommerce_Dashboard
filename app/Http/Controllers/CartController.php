<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use App\Http\Services\ProductService;
use Exception;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private CartService $cartService;
    private ProductService $productService;

    public function __constant(CartService $cartService, ProductService $productService)
    {
        $this->cartService = $cartService;
        $this->productService = $productService;
    }

    public function index()
    {
        $cartItems = $this->cartService->getAllCartItems();

        if (app()->getLocale() == 'en')
            return view('pages.app.ecommerce.carts', ['title' => __('trans.carts')], ['cartItems' => $cartItems]);
        if (app()->getLocale() == 'ar')
            return view('pages-rtl.app.ecommerce.carts', ['title' => __('trans.carts')], ['cartItems' => $cartItems]);
    }

    public function edit($id)
    {
        $cartItem = $this->cartService->getCartItemById($id);
        $products = $this->productService->getAllProducts();

        if (app()->getLocale() == 'en')
            return view('pages.app.ecommerce.edit-cart', ['title' => __('trans.edit_cart')], ['cartItem' => $cartItem, 'products' => $products]);
        if (app()->getLocale() == 'ar')
            return view('pages-rtl.app.ecommerce.edit-cart', ['title' => __('trans.edit_cart')], ['cartItem' => $cartItem, 'products' => $products]);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->cartService->updateCartItem($request, $id);
            return redirect('/carts');
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->cartService->deleteCartItem($id);
            return redirect('/carts');
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
