<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Repositories\CartItemRepository;
use App\Http\Repositories\ProductRepository;
use Exception;

class CartService
{

    private $cartItemRepository;
    private $productRepository;

    public function __construct(CartItemRepository $cartItemRepository, ProductRepository $productRepository)
    {
        $this->cartItemRepository = $cartItemRepository;
        $this->productRepository = $productRepository;
    }

    public function getAllCartItems()
    {
        return $this->cartItemRepository->getAllCartItems();
    }

    public function getCartItemById($id)
    {
        return $this->cartItemRepository->getCartItemById($id);
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    public function updateCartItem(Request $request, $id)
    {
        try {
            $formFields = $request->all();
            return $this->cartItemRepository->updateCartItem($formFields, $id);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteCartItem($id)
    {
        try {
            return $this->deleteCartItem($id);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
