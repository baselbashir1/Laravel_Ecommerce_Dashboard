<?php

namespace App\Http\Repositories;

use App\Models\OrderItem;

class OrderItemRepository {

    public function getAllOrderItems() {
        return OrderItem::all();
    }

    public function getOrderItemById($id) {
        return OrderItem::find($id);
    }

    public function getOrderItemsForOrder($id) {
        return OrderItem::where('order_id', $id)->get();
    }

    public function createOrderItem(array $data)
    {
        return OrderItem::create($data);
    }

    public function updateOrderItem(array $data, $id)
    {
        return OrderItem::whereId($id)->update($data);
    }

    public function deleteOrderItem($id)
    {
        return OrderItem::destroy($id);
    }
}
