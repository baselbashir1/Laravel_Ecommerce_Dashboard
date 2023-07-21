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

        $username = Order::query()
            ->select([DB::raw('u.name')])
            ->join('users AS u', 'u.id', '=', 'created_by')
            ->first();

        return view('pages.app.ecommerce.orders', ['title' => 'Orders'], ['orders' => $orders, 'username' => $username]);
    }

    public function show($id)
    {
        $orderItem = OrderItem::where('order_id', $id)->first();
        return view('pages.app.ecommerce.order-details', ['title' => 'Order Details'], ['orderItem' => $orderItem]);
    }
}
