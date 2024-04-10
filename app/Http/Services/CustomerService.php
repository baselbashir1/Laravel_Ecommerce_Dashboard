<?php

namespace App\Http\Services;

use App\Http\Repositories\CustomerRepository;

class CustomerService
{

    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getAllCustomers()
    {
        return $this->customerRepository->getAllCustomers();
    }

}
