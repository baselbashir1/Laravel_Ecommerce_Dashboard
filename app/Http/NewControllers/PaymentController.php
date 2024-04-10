<?php

namespace App\Http\Controllers;

use App\Http\Services\PaymentService;
use Exception;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        try {
            $payments = $this->paymentService->getAllPayments();

            if (app()->getLocale() == 'en')
                return view('pages.app.ecommerce.payments', ['title' => __('trans.payments')], ['payments' => $payments]);
            if (app()->getLocale() == 'ar')
                return view('pages-rtl.app.ecommerce.payments', ['title' => __('trans.payments')], ['payments' => $payments]);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
