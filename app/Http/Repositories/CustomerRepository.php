<?php

namespace App\Http\Repositories;

use App\Models\Customer;


class CustomerRepository {

    public function getAllCustomers() {
        return Customer::all();
    }

    public function getCustomerById($id) {
        return Customer::find($id);
    }

    public function createCustomer(array $data)
    {
        return Customer::create($data);
    }

    public function updateCustomer(array $data, $id)
    {
        return Customer::whereId($id)->update($data);
    }

    public function deleteCustomer($id)
    {
        return Customer::destroy($id);
    }
}
