<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCateSubCate;
use App\Models\ArticleCate;
use App\Models\ProductCate;
use App\Models\Article;

class ProductCateController extends Controller
{
    public function index()
    {
        // if (in_array($locale, config('app.supported_locales'))) {
        //     session(['locale' => $locale]);
        // }
        $product_cates = ProductCate::with("subCates")
                            ->get();
        $article_cates = ArticleCate::all();

        // foreach($product_cates as $rec) {
        //     print_r($rec->subCates);
        //     // foreach($rec->subCates as $one) {
        //     //     dd($rec->subCates);
        //     //     print_r($one->name??"");
        //     //     print_r(",");
        //     // }
        //     print_r("=============");
        // }
        // exit;
        return view('pages.home', compact('product_cates', 'article_cates'));
    }
    public function getProductCate($id, $tab)
    {
        $selected_tab = $tab;
        $product_cates = ProductCate::with("subCates")->get();
        $article_cates = ArticleCate::all();

        $product_sub_cates = ProductCateSubCate::where('product_cate_id', $id)->get();

        $product_cate_selected = ProductCate::with("subCates")->where('id', $id)->first();

        $articles_related = null;

        $articles_related = Article::where('product_cate_id', '=', $id)->get();
        return view('pages.product-cate', compact('product_cates', 'article_cates', 'product_sub_cates', 'product_cate_selected', 'articles_related', 'selected_tab'));
    }

    public function getProducts($subcate) {
        $products = Product::where('sub_cate_id', '=', $subcate)->get();
        // dd($products);
        return view('pages.products-template', compact('products'));
    }
}
