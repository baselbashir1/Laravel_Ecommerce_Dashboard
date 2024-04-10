<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Services\ProductService;

class ProductController extends Controller
{

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        try {
            $products = $this->productService->getAllProducts();

            if (app()->getLocale() == 'en')
                return view('pages.app.ecommerce.list', ['title' => __('trans.products')], ['products' => $products]);
            if (app()->getLocale() == 'ar')
                return view('pages-rtl.app.ecommerce.list', ['title' => __('trans.products')], ['products' => $products]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function show($id)
    {
        try {
            $product = $this->productService->getProductById($id);
            $productImages = $this->productService->getProductImagesForImage($product->id);

            if (app()->getLocale() == 'en')
                return view('pages.app.ecommerce.detail', ['title' => __('trans.product_details')], ['product' => $product, 'productImages' => $productImages]);
            if (app()->getLocale() == 'ar')
                return view('pages-rtl.app.ecommerce.detail', ['title' => __('trans.product_details')], ['product' => $product, 'productImages' => $productImages]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function create()
    {
        if (app()->getLocale() == 'en')
            return view('pages.app.ecommerce.add', ['title' => __('trans.add_product')]);
        if (app()->getLocale() == 'ar')
            return view('pages-rtl.app.ecommerce.add', ['title' => __('trans.add_product')]);
    }

    public function store(Request $request)
    {
        try {
            $this->productService->createProduct($request);
            return redirect('/products');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function edit($id)
    {
        try {
            $product = $this->productService->getProductById($id);
            $productImages = $this->productService->getProductImagesForImage($product->id);

            if (app()->getLocale() == 'en')
                return view('pages.app.ecommerce.edit', ['title' => __('trans.edit_product')], ['product' => $product, 'productImages' => $productImages]);
            if (app()->getLocale() == 'ar')
                return view('pages-rtl.app.ecommerce.edit', ['title' => __('trans.edit_product')], ['product' => $product, 'productImages' => $productImages]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->productService->updateProduct($request, $id);
            return redirect('/products');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            $this->productService->deleteProduct($id);
            return back();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function addProductImage(Request $request, $id)
    {
        try {
            $this->productService->addProductImage($request, $id);
            return redirect()->route('edit-product', $id);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function editProductImage(Request $request, $productId, $productImageId)
    {
        try {
            $this->productService->editProductImage($request, $productId, $productImageId);
            return redirect()->route('edit-product', $productId);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteProductImage($productId, $productImageId)
    {
        try {
            $this->productService->deleteProductImage($productId, $productImageId);
            return redirect()->route('edit-product', $productId);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
