<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class NewsCategory extends Model
{
    use HasFactory, AsSource;

    protected $table = "news_categories";
}
