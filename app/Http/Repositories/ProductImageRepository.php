<?php

namespace App\Http\Repositories;

use App\Models\ProductImage;

class ProductImageRepository
{

    public function getAllProductImages()
    {
        return ProductImage::all();
    }

    public function getProductImagesForImage($productId)
    {
        return ProductImage::where('product_id', $productId)->get();
    }

    public function getProductImageById($id)
    {
        return ProductImage::find($id);
    }

    public function createProductImage(array $data)
    {
        return ProductImage::create($data);
    }

    public function updateProductImage(array $data, $id)
    {
        return ProductImage::whereId($id)->update($data);
    }

    public function deleteProductImage($id)
    {
        return ProductImage::destroy($id);
    }
}
