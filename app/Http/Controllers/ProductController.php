<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductService;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();

        if (app()->getLocale() == 'en')
            return view('pages.app.ecommerce.list', ['title' => __('trans.products')], ['products' => $products]);
        if (app()->getLocale() == 'ar')
            return view('pages-rtl.app.ecommerce.list', ['title' => __('trans.products')], ['products' => $products]);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        $productImages = $this->productService->getProductImagesForImage($product->id);

        if (app()->getLocale() == 'en')
            return view('pages.app.ecommerce.detail', ['title' => __('trans.product_details')], ['product' => $product, 'productImages' => $productImages]);
        if (app()->getLocale() == 'ar')
            return view('pages-rtl.app.ecommerce.detail', ['title' => __('trans.product_details')], ['product' => $product, 'productImages' => $productImages]);
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
            return back()->withException($e);
        }
    }

    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        $productImages = $this->productService->getProductImagesForImage($product->id);

        if (app()->getLocale() == 'en')
            return view('pages.app.ecommerce.edit', ['title' => __('trans.edit_product')], ['product' => $product, 'productImages' => $productImages]);
        if (app()->getLocale() == 'ar')
            return view('pages-rtl.app.ecommerce.edit', ['title' => __('trans.edit_product')], ['product' => $product, 'productImages' => $productImages]);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->productService->updateProduct($request, $id);
            return redirect('/products');
        } catch (Exception $e) {
            return back()->withException($e);
        }
    }

    public function destroy($id)
    {
        try {
            $this->productService->deleteProduct($id);
            return redirect('/products');
        } catch (Exception $e) {
            return back()->withException($e);
        }
    }

    public function addProductImage(Request $request, $id)
    {
        try {
            $this->productService->addProductImage($request, $id);
            return redirect()->route('edit-product', $id);
        } catch (Exception $e) {
            return back()->withException($e);
        }
    }

    public function editProductImage(Request $request, $productId, $productImageId)
    {
        try {
            $this->productService->editProductImage($request, $productId, $productImageId);
            return redirect()->route('edit-product', $productId);
        } catch (Exception $e) {
            return back()->withException($e);
        }
    }

    public function deleteProductImage($productId, $productImageId)
    {
        try {
            $this->productService->deleteProductImage($productId, $productImageId);
            return redirect()->route('edit-product', $productId);
        } catch (Exception $e) {
            return back()->withException($e);
        }
    }
}
