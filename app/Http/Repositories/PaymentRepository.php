<?php

namespace App\Http\Repositories;

use App\Models\Payment;

class PaymentRepository {

    public function getAllPayments() {
        return Payment::all();
    }

    public function getPaymentById($id) {
        return Payment::find($id);
    }

    public function createPayment(array $data)
    {
        return Payment::create($data);
    }

    public function updatePayment(array $data, $id)
    {
        return Payment::whereId($id)->update($data);
    }

    public function deletePayment($id)
    {
        return Payment::destroy($id);
    }
}
