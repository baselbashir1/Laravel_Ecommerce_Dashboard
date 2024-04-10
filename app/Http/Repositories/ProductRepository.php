<?php

namespace App\Http\Repositories;

use App\Models\Product;

class ProductRepository {

    public function getAllProducts() {
        return Product::all();
    }

    public function getProductById($id) {
        return Product::find($id);
    }

    public function getLastProduct() {
        return Product::latest()->first();
    }

    public function createProduct(array $data)
    {
        return Product::create($data);
    }

    public function updateProduct(array $data, $id)
    {
        return Product::whereId($id)->update($data);
    }

    public function deleteProduct($id)
    {
        return Product::destroy($id);
    }
}
