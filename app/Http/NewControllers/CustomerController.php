<?php

namespace App\Http\Controllers;

use App\Http\Services\CustomerService;
use Exception;

class CustomerController extends Controller
{

    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        try {
            $customers = $this->customerService->getAllCustomers();
            return view('pages.app.ecommerce.customers', ['title' => 'Customers'], ['customers' => $customers]);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
