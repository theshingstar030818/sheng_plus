<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductCate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class ProductCateSubCate extends Model
{
    use HasFactory;
    use AsSource, Filterable, Attachable;

    protected $table = 'product_cate_sub_cates';

    public function productCate()
    {
        return $this->hasOne(ProductCate::class, 'id', 'product_cate_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'id', 'sub_cate_id');
    }
}
