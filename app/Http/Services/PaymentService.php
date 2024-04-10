<?php

namespace App\Http\Services;

use App\Http\Repositories\PaymentRepository;

class PaymentService
{

    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function getAllPayments()
    {
        return $this->paymentRepository->getAllPayments();
    }

}
