<?php

namespace App\Http\Controllers;

use App\Http\Services\OrderService;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderService->getAllOrders();

        if (app()->getLocale() == 'en')
            return view('pages.app.ecommerce.orders', ['title' => __('trans.orders')], ['orders' => $orders]);
        if (app()->getLocale() == 'ar')
            return view('pages-rtl.app.ecommerce.orders', ['title' => __('trans.orders')], ['orders' => $orders]);
    }

    public function show($id)
    {
        $orderItems = $this->orderService->getOrderItemsForOrder($id);

        if (app()->getLocale() == 'en')
            return view('pages.app.ecommerce.order-details', ['title' => __('trans.order_details')], ['orderItems' => $orderItems]);
        if (app()->getLocale() == 'ar')
            return view('pages-rtl.app.ecommerce.order-details', ['title' => __('trans.order_details')], ['orderItems' => $orderItems]);
    }
}
