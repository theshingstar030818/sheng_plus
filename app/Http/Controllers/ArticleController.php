<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ProductCateSubCate;
use App\Models\ArticleCate;
use App\Models\ProductCate;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $product_cates = ProductCate::with("subCates")->get();
        $article_cates = ArticleCate::all();

        return view('pages.article-list', compact('product_cates', 'article_cates'));
    }

    public function getArticle($id)
    {
        $product_cates = ProductCate::with("subCates")->get();
        $article_cates = ArticleCate::all();

        $query = Article::leftJoin('article_cates', 'articles.article_cate_id', '=', 'article_cates.id');
        $article = $query->where('articles.id', '=', $id)->first();

        return view('pages.article', compact('product_cates', 'article_cates', 'article'));
    }

    public function getArticles(Request $request)
    {
        $product_cate = $request->get('product_cate');
        $article_cates = $request->get('article_cates');
        $search_letters = $request->get('search_letters');
        $search_letters = trim($search_letters);

        $query = Article::select(DB::raw('articles.*, article_cates.name as name'))
                    ->leftJoin('article_cates', 'articles.article_cate_id', '=', 'article_cates.id');
        
        if (strlen($search_letters) != 0) {
            $query->where('title', 'like', '%'.$search_letters.'%');
        }
        if ($product_cate > 0) {
            $query->where('product_cate_id', '=', $product_cate);
        }
        if (count($article_cates) > 0) {
            // $query->where(function($q) {
            //     $q->where('age', '>', 25)
            //           ->orWhere('experience', '>', 5);
            // })
            $query->whereIn('article_cate_id', $article_cates);
        }

        $articles = $query->get();
        // dd($articles);
        return view('pages.articles-template', compact('articles'));
        // return response()->view('pages.articles-template', compact('articles'))->header('Content-Type', 'text/html');

    }
}
