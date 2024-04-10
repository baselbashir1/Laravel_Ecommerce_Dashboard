<?php

namespace App\Http\Services;

use App\Http\Repositories\OrderItemRepository;
use App\Http\Repositories\OrderRepository;

class OrderService
{
    private $orderRepository;
    private $orderItemRepository;

    public function __construct(OrderRepository $orderRepository, OrderItemRepository $orderItemRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
    }

    public function getAllOrders()
    {
        return $this->orderRepository->getAllOrders();
    }

    public function getOrderItemsForOrder($id)
    {
        return $this->orderItemRepository->getOrderItemsForOrder($id);
    }
}
