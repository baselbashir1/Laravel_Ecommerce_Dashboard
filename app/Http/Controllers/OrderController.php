<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        if (app()->getLocale() == 'en') return view('pages.app.ecommerce.orders', ['title' => __('trans.orders')], ['orders' => $orders]);
        if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.orders', ['title' => __('trans.orders')], ['orders' => $orders]);
    }

    public function show($id)
    {
        $orderItems = OrderItem::where('order_id', $id)->get();

        if (app()->getLocale() == 'en') return view('pages.app.ecommerce.order-details', ['title' => __('trans.order_details')], ['orderItems' => $orderItems]);
        if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.order-details', ['title' => __('trans.order_details')], ['orderItems' => $orderItems]);
    }
}
