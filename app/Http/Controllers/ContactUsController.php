<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticleCate;
use App\Models\ProductCate;

class ContactUsController extends Controller
{
    public function index()
    {
        $product_cates = ProductCate::with("subCates")->get();
        $article_cates = ArticleCate::all();

        return view('pages.contact', compact('product_cates', 'article_cates'));
    }
}
