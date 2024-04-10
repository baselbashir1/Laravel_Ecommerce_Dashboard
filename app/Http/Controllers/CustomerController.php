<?php

namespace App\Http\Controllers;

use App\Http\Services\CustomerService;

class CustomerController extends Controller
{
    private CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        $customers = $this->customerService->getAllCustomers();
        return view('pages.app.ecommerce.customers', ['title' => 'Customers'], ['customers' => $customers]);
    }
}
