<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCateSubCate;
use App\Models\ArticleCate;
use App\Models\ProductCate;
use App\Models\Article;

class ProductController extends Controller
{
    public function index()
    {
        // $product_cates = ProductCate::with("subCates")
        //                     ->get();
        // $article_cates = ArticleCate::all();

        // return view('pages.home', compact('product_cates', 'article_cates'));
    }

    public function getProduct($id) {
        $product_cates = ProductCate::with("subCates")->get();
        $article_cates = ArticleCate::all();
        $product = Product::where('id', '=', $id)->first();

        return view('pages.product', compact('product_cates', 'article_cates', 'product'));
    }
}
