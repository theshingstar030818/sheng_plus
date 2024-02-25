<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class ArticleCate extends Model
{
    use HasFactory;
    use AsSource, Filterable, Attachable;

    protected $table = 'article_cates';

    public function articles()
    {
        return $this->belongsTo(Article::class, "id", "article_cate_id");
    }
}
