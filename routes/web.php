<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Models\Company;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('product.detail');

Route::get('/gallery', function () {
    $company = Company::with([
        'contact',
        'socialMedias'
    ])->findOrFail(1);
    return view('gallery', compact('company'));
})->name('gallery.index');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.sendEmail');

// Route::get('/about-us', function () {
//     $aboutUs = Company::with('aboutUs')->findOrFail(1);
//     return view('about_us', compact('aboutUs'));
// })->name('about_us.index');

// Route::get('/contact', function () {
//     $contacts = Company::with('contact')->findOrFail(1);
//     return view('contact');
// })->name('contact.index');
