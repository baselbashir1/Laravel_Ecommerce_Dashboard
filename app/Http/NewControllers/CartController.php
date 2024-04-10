<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use Exception;
use Illuminate\Http\Request;

class CartController extends Controller
{

    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        try {
            $cartItems = $this->cartService->getAllCartItems();
            if (app()->getLocale() == 'en')
                return view('pages.app.ecommerce.carts', ['title' => __('trans.carts')], ['cartItems' => $cartItems]);
            if (app()->getLocale() == 'ar')
                return view('pages-rtl.app.ecommerce.carts', ['title' => __('trans.carts')], ['cartItems' => $cartItems]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function edit($id)
    {
        try {
            $cartItem = $this->cartService->getCartItemById($id);
            $products = $this->cartService->getAllProducts();
            if (app()->getLocale() == 'en')
                return view('pages.app.ecommerce.edit-cart', ['title' => __('trans.edit_cart')], ['cartItem' => $cartItem, 'products' => $products]);
            if (app()->getLocale() == 'ar')
                return view('pages-rtl.app.ecommerce.edit-cart', ['title' => __('trans.edit_cart')], ['cartItem' => $cartItem, 'products' => $products]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->cartService->updateCartItem($request, $id);
            return redirect('/carts');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            $this->cartService->deleteCartItem($id);
            return redirect('/carts');
        } catch (Exception $e) {
            throw $e;
        }
    }
}
