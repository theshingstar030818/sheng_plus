<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\News;

use App\Models\News;
use App\Models\NewsCategory;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Upload;
use Orchid\Attachment\File;
use Orchid\Attachment\Cropper;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

class NewsEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        $news_categories = NewsCategory::all()->pluck('name', 'id');
        
        return [
                Select::make('news.cate_id')
                    ->title('Category')
                    ->options($news_categories)
                    ->required(),
                DateTimer::make('news.published_date')
                    ->title('published_date'),
                Input::make('news.title')
                    ->title('Title')
                    ->placeholder('Enter News Title')
                    ->help('The title of the News to be updated.'),
                Input::make('news.desc')
                    ->title('Description')
                    ->placeholder('Enter News Description')
                    ->help('The Description of the News to be updated.'),
                Input::make('news.url')
                    ->title('URL')
                    ->placeholder('Enter News URL')
                    ->help('The URL of the News to be updated.'),

                Upload::make('news.img_path')
                    ->title('News Image')
                    ->maxFiles(1)
                    ->acceptedFiles('image/*')
                    ->help('Upload the image for the news'),
        ];
    }       
}
