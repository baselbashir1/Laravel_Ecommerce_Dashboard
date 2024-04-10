<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Repositories\ProductRepository;
use App\Http\Repositories\ProductImageRepository;
use Exception;

class ProductService
{
    private $productRepository;
    private $productImageRepository;

    public function __construct(ProductRepository $productRepository, ProductImageRepository $productImageRepository)
    {
        $this->productRepository = $productRepository;
        $this->productImageRepository = $productImageRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    public function getProductById($id)
    {
        return $this->productRepository->getProductById($id);
    }

    public function getProductImagesForImage($productId)
    {
        return $this->productImageRepository->getProductImagesForImage($productId);
    }

    public function createProduct(Request $request)
    {
        try {
            $formFields = $request->validate([
                'title' => 'required|unique:products,title',
                'image' => 'required',
                'price' => 'required',
                'description' => 'required'
            ]);

            if ($request->hasFile('image')) {
                $formFields['image'] = app('firebase.firestore')->database()->collection('Images')->document($_FILES['image']['name']);
                $firebase_storage_path = 'Images/';
                $name = $formFields['image']->id();
                $localfolder = public_path('firebase-temp-uploads') . '/';
                $image = $request['image'];
                $file = $name;
                if ($image->move($localfolder, $file)) {
                    $uploadedfile = fopen($localfolder . $file, 'r');
                    app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
                    unlink($localfolder . $file);
                }
            }

            $productData = [
                'title' => $formFields['title'],
                'image' => $formFields['image']->id(),
                'price' => $formFields['price'],
                'description' => $formFields['description'],
                'published' => 1,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ];

            $this->productRepository->createProduct($productData);

            if ($request->hasFile('product_image')) {
                $formFields['product_image'] = app('firebase.firestore')->database()->collection('Product Images')->document($_FILES['product_image']['name']);
                $firebase_storage_path = 'Product Images/';
                $name = $formFields['product_image']->id();
                $localfolder = public_path('firebase-temp-uploads') . '/';
                $image = $request['product_image'];
                $file = $name;

                if ($image->move($localfolder, $file)) {
                    $uploadedfile = fopen($localfolder . $file, 'r');
                    app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
                    unlink($localfolder . $file);
                }

                $productId = $this->productRepository->getLastProduct()->id;
                $productImageData = [
                    'image' => $formFields['product_image']->id(),
                    'product_id' => $productId
                ];

                $this->productImageRepository->createProductImage($productImageData);
            }

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateProduct(Request $request, $id)
    {
        try {
            $formFields = $request->all();
            $product = $this->productRepository->getProductById($id);

            if ($request->hasFile('image')) {
                $formFields['image'] = app('firebase.firestore')->database()->collection('Images')->document($_FILES['image']['name']);
                app('firebase.storage')->getBucket()->object('Images/' . $product->image)->delete();
                $firebase_storage_path = 'Images/';
                $name = $formFields['image']->id();
                $localfolder = public_path('firebase-temp-uploads') . '/';
                $image = $request['image'];
                $file = $name;
                if ($image->move($localfolder, $file)) {
                    $uploadedfile = fopen($localfolder . $file, 'r');
                    app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
                    unlink($localfolder . $file);
                }
            }

            $productData = [
                'title' => $formFields['title'],
                'image' => $formFields['image']->id(),
                'price' => $formFields['price'],
                'description' => $formFields['description'],
                'updated_by' => auth()->user()->id
            ];

            $this->productRepository->updateProduct($productData, $id);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteProduct($id)
    {
        try {
            $product = $this->productRepository->getProductById($id);
            $product->forceDelete();
            app('firebase.storage')->getBucket()->object('Images/' . $product->image)->delete();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function addProductImage(Request $request, $id)
    {
        try {
            $formFields = $request->validate([
                'product_image' => 'required'
            ]);

            if ($request->hasFile('product_image')) {
                $formFields['product_image'] = app('firebase.firestore')->database()->collection('Product Images')->document($_FILES['product_image']['name']);
                $firebase_storage_path = 'Product Images/';
                $name = $formFields['product_image']->id();
                $localfolder = public_path('firebase-temp-uploads') . '/';
                $image = $request['product_image'];
                $file = $name;
                if ($image->move($localfolder, $file)) {
                    $uploadedfile = fopen($localfolder . $file, 'r');
                    app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
                    unlink($localfolder . $file);
                }
            }

            $product = $this->productRepository->getProductById($id);

            $productImageData = [
                'image' => $formFields['product_image']->id(),
                'product_id' => $product->id
            ];

            $this->productImageRepository->createProductImage($productImageData);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function editProductImage(Request $request, $productId, $productImageId)
    {
        try {
            $formFields = $request->validate([
                'product_image' => 'required'
            ]);

            if ($request->hasFile('product_image')) {
                $formFields['product_image'] = app('firebase.firestore')->database()->collection('Product Images')->document($_FILES['product_image']['name']);
                // app('firebase.storage')->getBucket()->object('Product Images/' . $productImage->image)->delete();
                $firebase_storage_path = 'Product Images/';
                $name = $formFields['product_image']->id();
                $localfolder = public_path('firebase-temp-uploads') . '/';
                $image = $request['product_image'];
                $file = $name;
                if ($image->move($localfolder, $file)) {
                    $uploadedfile = fopen($localfolder . $file, 'r');
                    app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
                    unlink($localfolder . $file);
                }
            }

            $productImageData = [
                'image' => $formFields['product_image']->id()
            ];

            $this->productImageRepository->updateProductImage($productImageData, $productImageId);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteProductImage($productId, $productImageId)
    {
        try {
            $productImage = $this->productImageRepository->getProductImageById($productImageId);
            // $productImage = ProductImage::where('id', $productImageId)->first();
            app('firebase.storage')->getBucket()->object('Product Images/' . $productImage->image)->delete();
            $productImage->delete();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
