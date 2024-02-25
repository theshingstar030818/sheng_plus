<?php

namespace App\Orchid\Resources;

use App\Models\ProductCateSubCate;
use App\Models\ProductCate;

use Orchid\Crud\Resource;
use Orchid\Screen\TD;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Illuminate\Database\Eloquent\Model;

class ProductCateSubCateResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = ProductCateSubCate::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        $product_cates = ProductCate::all()->pluck('name', 'id');

        return [
            Input::make('name')
                ->name('name')
                ->title('Name')
                ->placeholder('Enter name here'),
            Select::make('product_cate_id')
                ->name('product_cate_id')
                ->title('Product Cate')
                ->options($product_cates)
                ->required(),
        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', 'ID'),
            TD::make('name', "Name")
            ->width('150px'),
            TD::make('product_cate_id', "Product Category")
                ->render(function (ProductCateSubCate $rec) {
                    $one = ProductCate::where('id', '=', $rec->product_cate_id)->first();
                    return $one->name??'';
                }),

            TD::make('created_at', 'Date of creation')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),

            TD::make('updated_at', 'Update date')
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
                }),
        ];
    }


    public static function navigationGroup(): string
    {
        return 'Main';
    }

    public static function label(): string
    {
        return 'Product Sub Categories';
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }

    /**
     * Get the text for the create resource button.
     *
     * @return string|null
     */
    public static function createButtonLabel(): string
    {
        return __('Create', [
            'resource' => static::singularLabel()
        ]);
        // return __('Create :resource', [
        //     'resource' => static::singularLabel()
        // ]);
    }

    /**
     * Get the text for the create resource toast.
     *
     * @return string
     */
    public static function createToastMessage(): string
    {
        return __('The :resource was created!', [
            'resource' => static::singularLabel()
        ]);
    }

    /**
     * Get the permission key for the resource.
     *
     * @return string|null
     */
    // public static function permission(): ?string
    // {
    //     return [
    //         'create' => 'create-your-resource',
    //         'update' => 'update-your-resource',
    //         'delete' => 'delete-your-resource',
    //     ];
    //     // return null;
    //     // return 'admin-default-permission';
    // }

    public static function permission(): ?string
    {
        return null;
    }
    /**
     * Get the number of models to return per page
     *
     * @return int
     */
    public static function perPage(): int
    {
        return 10;
    }

    public function rules(Model $model): array
    {
        return [
            'name' => 'required|string|max:500',
        ];
    }
}
