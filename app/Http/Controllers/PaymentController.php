<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();

        if (app()->getLocale() == 'en') return view('pages.app.ecommerce.payments', ['title' => __('trans.payments')], ['payments' => $payments]);
        if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.payments', ['title' => __('trans.payments')], ['payments' => $payments]);
    }
}
