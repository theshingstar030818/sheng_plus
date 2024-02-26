<?php

namespace App\Models;

use App\Models\ProductCateSubCate;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class ProductCate extends Model
{
    use HasFactory;
    use AsSource, Filterable, Attachable;

    protected $table = 'product_cates';


    public function subCates()
    {
        return $this->hasMany(ProductCateSubCate::class, 'product_cate_id', 'id');
        // return $this->belongsTo(ProductCateSubCate::class, 'product_cate_id', 'id');
    }
    public function articles()
    {
        return $this->belongsTo(Article::class, 'id', 'article_cate_id');
    }
}
