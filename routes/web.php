<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    $locale = Request::segment(1); // Get the first segment of the URL (language code)
    if (!in_array($locale, config('app.supported_locales'))) {
        // If the language code is not supported, default to 'en'
        $locale = 'en';
    }
    // dd($locale);
    // Redirect to the appropriate home route for the detected language
    return redirect()->route('home', ['locale' => $locale]);
});

Route::get('/', [App\Http\Controllers\ProductCateController::class, 'index'])->name('home');
Route::get('/language/{locale}', [App\Http\Controllers\LanguageController::class, 'switch'])->name('language.switch');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/contact-us', [App\Http\Controllers\ContactUsController::class, 'index'])->name('contact-us');
Route::get('/article-list', [App\Http\Controllers\ArticleController::class, 'index'])->name('article-list');
Route::post('/get-articles', [App\Http\Controllers\ArticleController::class, 'getArticles'])->name('get-articles');
Route::get('/article/{id}', [App\Http\Controllers\ArticleController::class, 'getArticle'])->name('get-article');
Route::get('/product-cate/{id}/{tab}', [App\Http\Controllers\ProductCateController::class, 'getProductCate'])->name('get-product-cate');
Route::post('/get-products/{subcate}', [App\Http\Controllers\ProductCateController::class, 'getProducts'])->name('get-products');
Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'getProduct'])->name('get-product');



// Add other routes as needed



