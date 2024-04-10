<?php

namespace App\Http\Repositories;

use App\Models\CartItem;

class CartItemRepository {

    public function getAllCartItems() {
        return CartItem::all();
    }

    public function getCartItemById($id) {
        return CartItem::find($id);
    }

    public function createCartItem(array $data)
    {
        return CartItem::create($data);
    }

    public function updateCartItem(array $data, $id)
    {
        return CartItem::whereId($id)->update($data);
    }

    public function deleteCartItem($id)
    {
        return CartItem::destroy($id);
    }
}
