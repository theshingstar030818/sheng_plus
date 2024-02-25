<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;

class News extends Model
{
    use HasFactory, AsSource, Attachable;
    protected $fillable = [
        'published_date',
        'title',
        'desc',
        'url',
        'cate_id',
        'img_path'
    ];
    protected $table = "news";
}
