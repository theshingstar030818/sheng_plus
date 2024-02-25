<?php

namespace App\Orchid\Resources;

use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use Orchid\Crud\Filters\DefaultSorted;
use Orchid\Crud\ResourceRequest;

use Illuminate\Database\Eloquent\Model;

use App\Models\ProductCate;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;

class ProductCateResource extends Resource
{
    public static $model = ProductCate::class;

    public function fields(): array
    {
        return [
            Input::make('name')
                ->name('name')
                ->title('Name')
                ->placeholder('Enter name here'),
            Input::make('description')
                ->name('description')
                ->title('Description')
                ->placeholder('Enter description here'),
            Upload::make('img')
                ->name('img')
                ->title('Category Image')
                ->maxFiles(1)
                ->acceptedFiles('image/*')
                ->help('Upload the image for the Category'),
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
            TD::make('description', "Description")
            ->width('300px'),
            TD::make('img', 'Image')
                ->render(function (ProductCate $rec) {
                    $attachmentId = $rec->img;
                    $attachment = \Orchid\Attachment\Models\Attachment::where('id', '=', $attachmentId)->first();
                    // Get the full URL for local storage
                    if ($attachment) {
                        $path = $attachment->path.$attachment->name.".".$attachment->extension;
                        $path = getFullImageAddress($path);
                    } else {
                        $path = null;
                    }
                    // dd($path);

                    return $path == null ? "" : "<img src='{$path}' alt='Image' style='width: 70px;'>";
                }),

            // TD::make('created_at', 'Date of creation')
            //     ->render(function ($model) {
            //         return $model->created_at->toDateTimeString();
            //     }),

            // TD::make('updated_at', 'Update date')
            //     ->render(function ($model) {
            //         return $model->updated_at->toDateTimeString();
            //     }),
        ];
    }

    public static function navigationGroup(): string
    {
        return 'Main';
    }

    public static function label(): string
    {
        return 'Product Categories';
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
            'description' => 'required|string|max:1000',
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
        return ['subCates'];
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

    /**
     * Action to create and update the model
     *
     * @param ResourceRequest $request
     * @param Model           $model
     */
    public function onSave(ResourceRequest $request, Model $model)
    {
        // dd($request->all());
        $model->forceFill([
                // $request->all(),
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'img' => $request->get('img')[0]
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
        return "Manage Product Categories";
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
