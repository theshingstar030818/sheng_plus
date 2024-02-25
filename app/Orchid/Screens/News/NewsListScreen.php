<?php

namespace App\Orchid\Screens\News;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
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

use App\Orchid\Layouts\News\NewsEditLayout;

class NewsListScreen extends Screen
{
    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'News';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'Latest News';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Add News')
                ->modal('CreateNewsModal')
                ->method('create')
                ->icon('plus'),
        ];
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        // dd(News::latest()->get());
        return [
            'newses' => News::latest()->get(),
        ];
    }
    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        $news_categories = NewsCategory::all()->pluck('name', 'id');

        return [
            Layout::table('newses', [
                // TD::make('name'),
                TD::make('cate_id', 'Category')
                    ->render(function (News $news) {
                        // Select::make('news.cate_id')
                        // ->title('Category')
                        // ->options($news_categories)
                        // ->required(),
                        $news_cate = NewsCategory::where('id', '=', $news->cate_id)->first();
                        return $news_cate->name;
                    }),
                TD::make('published_date', 'Published Date'),
                TD::make('title', 'Title'),
                TD::make('desc', 'Description'),
                TD::make('url', 'URL'),
                TD::make('img_path', 'Image')
                    ->render(function (News $news) {
                        $attachmentId = $news->img_path;
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
                TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (News $news) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        // ModalToggle::make('Edit')
                        //     ->modal('EditNewsModal')
                        //     ->method('update', ['id' => $news->id])
                        //     ->icon('bs.pencil')
                        //     ->class('mr-2'), // Add margin-right for spacing
                        Link::make(__('Edit'))
                            ->route('platform.news.edit', $news->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm('After deleting, the news will be gone forever.')
                            ->method('delete', [
                                'id' => $news->id,
                            ]),
                    ])),
            ]),

            Layout::modal('CreateNewsModal',  NewsEditLayout::class)
                ->title('Create')
                ->applyButton('Create'),

            // Layout::modal('EditNewsModal', NewsEditLayout::class)
            //     ->title('Edit')
            //     ->applyButton('Update')
            //     ->async('asyncNews')
                // ->method('edit', ['id' => $news->id])

        ];
    }
    
    // public function update(News $news, Request $request)
    // {
    //     $news->fill($request->get('news'));
    //     $news->save();

    //     return redirect()->route('platform.news.list');
    // }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function create(Request $request)
    {
        // Validate form data, save news category to database, etc.
        $request->validate([
            'news.published_date' => 'required',
            'news.title' => 'required|max:255',
            'news.desc' => 'required|max:1000',
            'news.img_path' => 'required',
        ]);
        // Retrieve the attachment using the ID and get the file path
        // dd($request->all(), $request->input('news.img_path'));

        $news = new News();
        $news->published_date = $request->input('news.published_date');
        $news->title = $request->input('news.title');
        $news->desc = $request->input('news.desc');
        $news->url = $request->input('news.url');
        $news->img_path = $request->input('news.img_path')[0];
        $news->cate_id = $request->input('news.cate_id');
        $news->save();
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function update(Request $request, News $news)
    {
        Toast::info('Hello, world! I am in update().');

        // Validate form data, save news category to database, etc.
        $request->validate([
            'news.published_date' => 'required',
            'news.title' => 'required|max:255',
            'news.desc' => 'required|max:1000',
            // 'news.img_path' => 'required',
        ]);
        $path = $request->input('news.img_path');
        $attachmentId = $request->input('news.img_path');
        $attachment = \Orchid\Attachment\Models\Attachment::where('id', $attachmentId)->first();

        // Get the full URL for local storage
        if ($attachment) {
            $path = $attachment->path.$attachment->name.".".$attachment->extension;
            // $path = asset('storage/' . $path);
        } else {
            $path = null;
        }

        $news->published_date = $request->input('news.published_date');
        $news->title = $request->input('news.title');
        $news->desc = $request->input('news.desc');
        $news->url = $request->input('news.url');
        $news->img_path = $path;
        $news->cate_id = $request->input('news.cate_id');
        $news->save();

        Toast::info('News updated successfully.');
    }

    /**
     * @param News $news
     *
     * @return void
     */
    // public function delete(News $news)
    // {
    //     Toast::info('Hello, world! I am in delete().');
    //     $news->delete();
    // }
    public function delete(Request $request): void
    {
        // Toast::info('Hello, world! I am in delete().');
        News::findOrFail($request->get('id'))->delete();
    }

    public function asyncNews(News $news): iterable
    {
        // dd($news);
        Toast::info('Hello, world! I am in edit().');
        // $news = News::findOrFail($request->get('id'));

        return [
            'news' => $news,
        ];
    }
}
