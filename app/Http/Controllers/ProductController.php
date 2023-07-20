<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Http\Requests\ServiceRequest;
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
        return view('pages.app.ecommerce.detail', ['title' => 'Product Details'], ['product' => $product]);
    }

    public function create()
    {
        if (app()->getLocale() == 'en') return view('pages.app.ecommerce.add', ['title' => 'Add Service']);
        if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.add', ['title' => 'Add Service']);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
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
        return view('pages.app.ecommerce.edit', ['title' => 'Edit Product'], ['product' => $product]);
        // if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.edit', ['title' => 'Edit Service'], ['service' => $service, 'serviceImages' => $serviceImages]);
    }

    public function update(Request $request, $id)
    {
        $formFields = $request->all();
        $product = Product::where('id', $id)->first();

        if ($request->hasFile('image')) {
            $formFields['image'] = app('firebase.firestore')->database()->collection('Images')->document($product->image);
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

        // if ($request->hasFile('service_image')) {
        //     $formFields['service_image'] = $request->file('service_image')->store('images', 'public');
        // }

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
        // $serviceImages = ServiceImage::where('service_id', $service->id);
        // $serviceImages->delete();

        $product = Product::where('id', $id)->first();
        $product->forceDelete();
        app('firebase.storage')->getBucket()->object('Images/' . $product->image)->delete();

        return back();
    }
}
