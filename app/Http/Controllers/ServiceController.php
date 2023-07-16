<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();

        if (app()->getLocale() == 'en') return view('pages.app.ecommerce.shop', ['title' => 'Dashboard'], ['services' => $services]);
        if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.shop', ['title' => 'Dashboard'], ['services' => $services]);
    }

    public function services()
    {
        $services = Service::all();
        $serviceImages = ServiceImage::all();

        if (app()->getLocale() == 'en') return view('pages.app.ecommerce.list', ['title' => 'Services'], ['services' => $services, 'serviceImages' => $serviceImages]);
        if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.list', ['title' => 'Services'], ['services' => $services, 'serviceImages' => $serviceImages]);
    }

    public function show(Service $service)
    {
        $serviceImages = ServiceImage::where('service_id', $service->id)->get();
        if (app()->getLocale() == 'en') return view('pages.app.ecommerce.detail', ['title' => 'Service Details'], ['service' => $service, 'serviceImages' => $serviceImages]);
        if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.detail', ['title' => 'Service Details'], ['service' => $service, 'serviceImages' => $serviceImages]);
    }

    public function create()
    {
        if (app()->getLocale() == 'en') return view('pages.app.ecommerce.add', ['title' => 'Add Service']);
        if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.add', ['title' => 'Add Service']);
    }

    public function store(ServiceRequest $request)
    {
        $formFields = $request->all();

        if ($request->hasFile('picture')) {
            $formFields['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        if ($request->hasFile('service_image')) {
            $formFields['service_image'] = $request->file('service_image')->store('images', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Service::create($formFields);

        $service_id = Service::latest()->first()->id;

        ServiceImage::create([
            'image' => $formFields['service_image'],
            'service_id' => $service_id
        ]);

        if (app()->getLocale() == 'en') return redirect('/modern-dark-menu/dashboard');
        if (app()->getLocale() == 'ar') return redirect('/rtl/modern-dark-menu/dashboard');
    }

    public function edit(Service $service)
    {
        $serviceImages = ServiceImage::where('service_id', $service->id)->get();

        if (app()->getLocale() == 'en') return view('pages.app.ecommerce.edit', ['title' => 'Edit Service'], ['service' => $service, 'serviceImages' => $serviceImages]);
        if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.edit', ['title' => 'Edit Service'], ['service' => $service, 'serviceImages' => $serviceImages]);
    }

    public function update(Request $request, Service $service)
    {
        $formFields = $request->all();

        if ($request->hasFile('picture')) {
            $formFields['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        if ($request->hasFile('service_image')) {
            $formFields['service_image'] = $request->file('service_image')->store('images', 'public');
        }

        $service->update($formFields);

        if (app()->getLocale() == 'en') return redirect('/modern-dark-menu/dashboard');
        if (app()->getLocale() == 'ar') return redirect('/rtl/modern-dark-menu/dashboard');
    }

    public function destroy(Request $request, Service $service)
    {
        $serviceImages = ServiceImage::where('service_id', $service->id);

        $serviceImages->delete();
        $service->delete();

        return back();
    }
}
