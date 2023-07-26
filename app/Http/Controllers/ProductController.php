<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Http\Requests\ServiceRequest;
use App\Models\ProductImage;
use Google\Auth\Credentials\ServiceAccountCredentials;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->where('published', '=', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(5);

        return view('pages.app.ecommerce.shop', ['title' => 'Dashboard'], ['products' => $products]);
        // return view('product.index', ['products' => $products]);
    }

    public function products()
    {
        $products = Product::all();

        // $serviceImages = ServiceImage::all();

        return view('pages.app.ecommerce.list', ['title' => 'Products'], ['products' => $products]);
        // if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.list', ['title' => 'Services'], ['services' => $services, 'serviceImages' => $serviceImages]);
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        $productImages = ProductImage::where('product_id', $product->id)->get();

        return view('pages.app.ecommerce.detail', ['title' => 'Product Details'], ['product' => $product, 'productImages' => $productImages]);
    }

    public function create()
    {
        if (app()->getLocale() == 'en') return view('pages.app.ecommerce.add', ['title' => 'Add Product']);
        if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.add', ['title' => 'Add Product']);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required|unique:products,title',
            'image' => 'required',
            'price' => 'required',
            'product_image' => 'required',
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

        // if ($request->hasFile('service_image')) {
        //     $formFields['service_image'] = $request->file('service_image')->store('images', 'public');
        // }

        Product::create([
            'title' => $formFields['title'],
            'image' => $formFields['image']->id(),
            'price' => $formFields['price'],
            'description' => $formFields['description'],
            'published' => 1,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ]);

        $product_id = Product::latest()->first()->id;

        ProductImage::create([
            'image' => $formFields['product_image']->id(),
            'product_id' => $product_id
        ]);

        // $service_id = Service::latest()->first()->id;

        // ServiceImage::create([
        //     'image' => $formFields['service_image'],
        //     'service_id' => $service_id
        // ]);

        return redirect('/products');
        // if (app()->getLocale() == 'ar') return redirect('/rtl/dashboard');
    }

    public function edit($id)
    {
        // $serviceImages = ServiceImage::where('service_id', $service->id)->get();
        $product = Product::where('id', $id)->first();
        $productImages = ProductImage::where('product_id', $product->id)->get();

        return view('pages.app.ecommerce.edit', ['title' => 'Edit Product'], ['product' => $product, 'productImages' => $productImages]);
        // if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.edit', ['title' => 'Edit Service'], ['service' => $service, 'serviceImages' => $serviceImages]);
    }

    public function update(Request $request, $id)
    {
        $formFields = $request->all();
        $product = Product::where('id', $id)->first();

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

        Product::where('id', $id)->update([
            'title' => $formFields['title'],
            'image' => $formFields['image']->id(),
            'price' => $formFields['price'],
            'description' => $formFields['description'],
            'updated_by' => auth()->user()->id
        ]);

        // if (app()->getLocale() == 'en') 
        return redirect('/products');
        // if (app()->getLocale() == 'ar') return redirect('/rtl/dashboard');
    }

    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        $product->forceDelete();
        app('firebase.storage')->getBucket()->object('Images/' . $product->image)->delete();

        return back();
    }

    public function addProductImage(Request $request, $id)
    {
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

        $product = Product::where('id', $id)->first();

        ProductImage::create([
            'image' => $formFields['product_image']->id(),
            'product_id' => $product->id
        ]);

        // return redirect()->route('product-details', $id);
        return redirect()->route('edit-product', $id);
    }

    public function editProductImage(Request $request, $productId, $imageProductId)
    {
        $formFields = $request->validate([
            'product_image' => 'required'
        ]);

        $productImage = ProductImage::where('id', $imageProductId)->first();

        if ($request->hasFile('product_image')) {
            $formFields['product_image'] = app('firebase.firestore')->database()->collection('Product Images')->document($_FILES['product_image']['name']);
            app('firebase.storage')->getBucket()->object('Product Images/' . $productImage->image)->delete();
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

        ProductImage::where('id', $imageProductId)->update([
            'image' => $formFields['product_image']->id()
        ]);

        return redirect()->route('edit-product', $productId);
    }
}
