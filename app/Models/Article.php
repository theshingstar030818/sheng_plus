<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Article extends Model
{
    use HasFactory;
    use AsSource, Filterable, Attachable;

    protected $table = 'articles';
    public function productCate()
    {
        return $this->hasOne(ProductCate::class, "id", "product_cate_id");
    }
    public function articleCate()
    {
        return $this->hasOne(ArticleCate::class, "id", "article_cate_id");
    }
}
