<?php

namespace App\Orchid\Resources;

use DateTime;
use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use App\Models\Article;
use App\Models\ArticleCate;
use App\Models\ProductCate;
use Orchid\Screen\Fields\SimpleMDE;
use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\ResourceRequest;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Crud\Filters\DefaultSorted;

class ArticleResource extends Resource
{
    public static $model = Article::class;

    public function fields(): array
    {
        $article_cates = ArticleCate::all()->pluck('name', 'id');
        $product_cates = ProductCate::all()->pluck('name', 'id');

        return [
            Select::make('article_cate_id')
                ->name('article_cate_id')
                ->title('Article Category')
                ->options($article_cates)
                ->required(),
            Select::make('product_cate_id')
                ->name('product_cate_id')
                ->title('Product Category')
                ->options($product_cates)
                ->required(),
            Input::make('title')
                ->name('title')
                ->title('Title')
                ->placeholder('Enter title here'),
            // Input::make('content')
            //     ->name('content')
            //     ->title('Content')
            //     ->placeholder('Enter Content here'),
            SimpleMDE::make('content')
                ->title('Content')
                ->popover('SimpleMDE is a simple, embeddable, and beautiful JS markdown editor'),
            // Input::make('published_date')
            //     ->name('published_date')
            //     ->title('Published Date')
            //     ->placeholder('Enter Published Date here'),
            Input::make('date')
                ->name('published_date')
                ->type('date')
                ->title('Published Date')
                ->value(function($field_value) {
                    $datetime = new DateTime($field_value);
                    return $datetime->format('Y-m-d');
                })
                ->horizontal(),

            Upload::make('img')
                ->name('img')
                ->title('Article Image')
                ->acceptedFiles('image/*')
                ->help('Upload article image'),
            ];
    }

    public function columns(): array
    {
        return [
            TD::make('id', 'ID'),
            TD::make('article_cate_id', "Article Category")
                ->render(function (Article $rec) {
                    $one = ArticleCate::where('id', '=', $rec->article_cate_id)->first();
                    return $one->name??'';
                }),
            TD::make('product_cate_id', "Product Category")
                ->render(function (Article $rec) {
                    $one = ProductCate::where('id', '=', $rec->product_cate_id)->first();
                    return $one->name??'';
                }),
            TD::make('title', "Title")
            ->width('150px'),
            TD::make('content', "Content")
                ->width('300px')
                ->render(function(Article $rec) {
                    return substr($rec->content, 0, 100)."..";
                })
            ->width('200px'), // Set the width of the column
            TD::make('img', 'Image')
                ->render(function (Article $rec) {
                    $img_tag_content = "";
                    $attachmentId = $rec->img;
                    $attachment = \Orchid\Attachment\Models\Attachment::where('id', '=', $attachmentId)->first();
                    // Get the full URL for local storage
                    $path = null;
                    if ($attachment) {
                        $path = $attachment->path.$attachment->name.".".$attachment->extension;
                        $path = getFullImageAddress($path);
                    }
                    $img_tag_content = $path == null? "" : "<img src='".$path."' alt='Image' style='width: 100px;margin-right: 5px;'>";

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
        return 'Articles';
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
            'title' => 'required|string|max:500',
            'content' => 'required|string|max:1000',
            'img' => 'required',
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
        return ['articleCate', 'productCate'];
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
        // dd($request);
        $model->forceFill([
                // $request->all(),
                'article_cate_id' => $request->get('article_cate_id'),
                'product_cate_id' => $request->get('product_cate_id'),
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'published_date' => $request->get('published_date'),
                'img' => $request->get('img')==null ? null : ($request->get('img')[0]??null),
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
        return "Manage Articles";
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

    /**
     * Get the text for the create resource button.
     *
     * @return string|null
     */
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
