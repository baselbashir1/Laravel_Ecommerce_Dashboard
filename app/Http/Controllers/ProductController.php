<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;

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

        // $formFields = $request->all();

        // $formFields = $request->all();

        // edit here add /storage/....
        if ($request->hasFile('image')) {
            $formFields['image'] = '/storage/' . $request->file('image')->store('images', 'public');
        }

        // if ($request->hasFile('service_image')) {
        //     $formFields['service_image'] = $request->file('service_image')->store('images', 'public');
        // }

        // $formFields['user_id'] = auth()->id();

        Product::create([
            'title' => $formFields['title'],
            'image' => $formFields['image'],
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
        // $formFields = $request->all();
        $formFields = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = '/storage/' . $request->file('image')->store('images', 'public');
        }

        // if ($request->hasFile('service_image')) {
        //     $formFields['service_image'] = $request->file('service_image')->store('images', 'public');
        // }

        // $service->update($formFields);
        Product::where('id', $id)->update([
            'title' => $formFields['title'],
            'image' => $formFields['image'],
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
        Product::where('id', $id)->delete();
        // $service->delete();

        return back();
    }
}
