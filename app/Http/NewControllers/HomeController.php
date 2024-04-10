<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (app()->getLocale() == 'en') return view('pages.app.ecommerce.shop', ['title' => __('trans.dashboard')]);
        if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.shop', ['title' => __('trans.dashboard')]);
    }
}
