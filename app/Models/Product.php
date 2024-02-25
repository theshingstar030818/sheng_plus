<?php

namespace App\Models;

use App\Models\ProductCate;
use App\Models\ProductCateSubCate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Product extends Model
{
    use HasFactory;
    use AsSource, Filterable, Attachable;

    protected $table = 'products';

    public function productCateSubCate()
    {
        return $this->hasOne(ProductCateSubCate::class, 'id', 'sub_cate_id');
    }
    protected $casts = [
        'imgs' => 'array',
    ];
}
