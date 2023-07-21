<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();

        return view('pages.app.ecommerce.payments', ['title' => 'Payments'], ['payments' => $payments]);
    }
}
