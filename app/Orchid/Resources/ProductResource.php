<?php

namespace App\Orchid\Resources;

use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use Orchid\Crud\Filters\DefaultSorted;
use Orchid\Crud\ResourceRequest;
use Orchid\Screen\Fields\SimpleMDE;

use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\ProductCateSubCate;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
class ProductResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Product::class;

    public function fields(): array
    {
        $product_cate_sub_cates = ProductCateSubCate::all()->pluck('name', 'id');

        return [
            Select::make('sub_cate_id')
                ->name('sub_cate_id')
                ->title('Product Sub Category')
                ->options($product_cate_sub_cates)
                ->required(),
            Input::make('name')
                ->name('name')
                ->title('Name')
                ->placeholder('Enter name here'),
            Input::make('desc')
                ->name('desc')
                ->title('Description')
                ->placeholder('Enter description here'),
            Input::make('dimension')
                ->name('dimension')
                ->title('Dimension')
                ->placeholder('Enter dimension here'),

            Upload::make('imgs')
                ->name('imgs')
                ->title('Product Images')
                ->maxFiles(10)
                ->acceptedFiles('image/*')
                ->help('Upload product images')
                ->value(function ($field_value) {
                    // dd($field_value);
                    if (is_object($field_value)) {
                        return [];
                    } elseif (is_string($field_value)) {
                        return json_decode($field_value);
                    }
                }),

            SimpleMDE::make('tab_one')
                ->title('First Tab Content'),
            Upload::make('tab_one_img')
                ->name('tab_one_img')
                ->title('First Tab Image')
                ->maxFiles(1)
                ->acceptedFiles('image/*')
                ->help('Upload image for the first tab'),

            SimpleMDE::make('tab_two')
                ->title('Second Tab Content'),
            Upload::make('tab_two_img')
                ->name('tab_two_img')
                ->title('Second Tab Image')
                ->maxFiles(1)
                ->acceptedFiles('image/*')
                ->help('Upload image for the second tab'),

            SimpleMDE::make('tab_three')
                ->title('Third Tab Content'),
            Upload::make('tab_three_img')
                ->name('tab_three_img')
                ->title('Third Tab Image')
                ->maxFiles(1)
                ->acceptedFiles('image/*')
                ->help('Upload image for the three tab'),

            SimpleMDE::make('tab_four')
                ->title('Fourth Tab Content'),
            Upload::make('tab_four_img')
                ->name('tab_four_img')
                ->title('Fourth Tab Image')
                ->maxFiles(1)
                ->acceptedFiles('image/*')
                ->help('Upload image for the four tab'),
            ];
    }

    public function columns(): array
    {
        return [
            TD::make('id', 'ID'),
            TD::make('sub_cate_id', "Product Sub Category")
                ->render(function (Product $rec) {
                    $one = ProductCateSubCate::where('id', '=', $rec->sub_cate_id)->first();
                    return $one->name??'';
                }),
            TD::make('name', "Name")
            ->width('150px'),
            TD::make('desc', "Description")
            ->width('300px')
            ->render(function(Product $rec) {
                return substr($rec->desc, 0, 100)."..";

            })
            ->width('200px'), // Set the width of the column
            TD::make('dimension', "Dimension"),
            TD::make('imgs', 'Images')
                ->render(function (Product $rec) {
                    $img_tag_content = "";
                    // dd(json_decode($rec->imgs));
                    foreach(json_decode($rec->imgs) as $attachmentId) {
                        $attachment = \Orchid\Attachment\Models\Attachment::where('id', '=', $attachmentId)->first();
                        // Get the full URL for local storage
                        $path = null;
                        if ($attachment) {
                            $path = $attachment->path.$attachment->name.".".$attachment->extension;
                            $path = getFullImageAddress($path);
                        }
                        $tmp = $path == null? "" : "<img src='".$path."' alt='Image' style='width: 100px;margin-right: 5px;'>";
                        $img_tag_content = $img_tag_content.$tmp;
                    }
                    return $img_tag_content;
                }),
        ];
    }

    public static function navigationGroup(): string
    {
        return 'Main';
    }

    public static function label(): string
    {
        return 'Products';
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
        return [
            new DefaultSorted('id', 'asc'),
            // new DefaultSorted('name', 'asc'),
        ];
    }

    /**
     * Get the validation rules that apply to save/update.
     *
     * @return array
     */
    public function rules(Model $model): array
    {
        return [
            'name' => 'required|string|max:500',
            'desc' => 'required|string|max:1000',
            'imgs' => 'required',
        ];
    }

    /**
     * Get the resource should be displayed in the navigation
     *
     * @return bool
     */
    public static function displayInNavigation(): bool
    {
        return true;
    }

    /**
     * Get relationships that should be eager loaded when performing an index query.
     *
     * @return array
     */
    public function with(): array
    {
        // return [];
        return ['productCateSubCate'];
    }

    /**
     * Get the number of models to return per page
     *
     * @return int
     */
    public static function perPage(): int
    {
        return 5;
    }

    /**
     * Action to create and update the model
     *
     * @param ResourceRequest $request
     * @param Model           $model
     */
    public function onSave(ResourceRequest $request, Model $model)
    {
        $jsonString = json_encode($request->get('imgs')??[]);
        // dd($jsonString);
        // dd($request->get('tab_one_img'));
        // dd($request->get('tab_one_img')[0]);
        // dd($request->all());
        $model->forceFill([
                // $request->all(),
                'sub_cate_id' => $request->get('sub_cate_id'),
                'name' => $request->get('name'),
                'desc' => $request->get('desc'),
                'dimension' => $request->get('dimension'),
                'tab_one' => $request->get('tab_one'),
                'tab_two' => $request->get('tab_two'),
                'tab_three' => $request->get('tab_three'),
                'tab_four' => $request->get('tab_four'),
                'tab_one_img' => $request->get('tab_one_img')==null ? null : ($request->get('tab_one_img')[0]??null),
                'tab_two_img' => $request->get('tab_two_img')==null ? null : ($request->get('tab_two_img')[0]??null),
                'tab_three_img' => $request->get('tab_three_img')==null ? null : ($request->get('tab_three_img')[0]??null),
                'tab_four_img' => $request->get('tab_four_img')==null ? null : ($request->get('tab_four_img')[0]??null),
                'imgs' => $jsonString
            ])->save();
    }

    /**
     * Action to delete a model
     *
     * @param Model $model
     *
     * @throws Exception
     */
    public function onDelete(Model $model)
    {
        $model->delete();
    }

    /**
     * Get the permission key for the resource.
     *
     * @return string|null
     */
    public static function permission(): ?string
    {
        return null;
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(): array
    {
        return [
            // DeleteAction::class,
        ];
    }

    // public function getUriKey()
    // {
    //     return Str::kebab(class_basename($this));
    // }
    public function getRouteKey()
    {
        return 'slug'; // Use the 'slug' column for route model binding
    }

    /**
     * Get the descriptions for the screen.
     *
     * @return null|string
     */
    public static function description(): ?string
    {
        return "Manage Products";
    }

    /**
     * Get the text for the list breadcrumbs.
     *
     * @return string
     */
    public static function listBreadcrumbsMessage(): string
    {
        return static::label();
    }

    /**
     * Get the text for the create breadcrumbs.
     *
     * @return string
     */
    public static function createBreadcrumbsMessage(): string
    {
        return __('New :resource', ['resource' => static::singularLabel()]);
    }

    /**
     * Get the text for the edit breadcrumbs.
     *
     * @return string
     */
    public static function editBreadcrumbsMessage(): string
    {
        return __('Edit :resource', ['resource' => static::singularLabel()]);
    }

    public static function createButtonLabel(): string
    {
        return 'Create';
        // return __('Create :resource', [
        //     'resource' => static::singularLabel()
        // ]);
    }

    public static function updateButtonLabel(): string
    {
        return 'Update';
        // return __('Create :resource', [
        //     'resource' => static::singularLabel()
        // ]);
    }

    public static function deleteButtonLabel(): string
    {
        return 'Delete';
        // return __('Create :resource', [
        //     'resource' => static::singularLabel()
        // ]);
    }
}
