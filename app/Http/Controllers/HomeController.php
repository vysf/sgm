<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        $products = Product::take(6)->get();
        $company = Company::with([
            'aboutUs', 
            'keyFeatures', 
            'contact',
            'commitment',
            'socialMedias'
        ])
        ->get()
        ->first();
        // dd($company->commitment->commitment_list);
        return view('index', compact('products', 'company'));
    }
}
