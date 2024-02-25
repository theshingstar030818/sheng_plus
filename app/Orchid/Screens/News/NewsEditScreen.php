<?php

declare(strict_types=1);

namespace App\Orchid\Screens\News;

use App\Models\News;
use App\Models\NewsCategory;

use App\Orchid\Layouts\Role\RolePermissionLayout;
use App\Orchid\Layouts\News\NewsEditLayout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Orchid\Access\Impersonation;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Upload;
use Orchid\Attachment\File;
use Orchid\Attachment\Cropper;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;


class NewsEditScreen extends Screen
{
    /**
     * @var News
     */
    public $news;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Request $request, News $news): iterable
    {
        // $this->news = News::where('id', $request->input('id')).first();
        $this->news = $news;
        return [
            'news' => $this->news,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->news ? 'Edit News' : 'Create News';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'News create / edit.';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        // dd($this->news);
        return [
            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->confirm(__('After deleting, the news will be gone forever.'))
                ->method('remove')
                ->canSee($this->news->exists),

            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        $news_categories = NewsCategory::all()->pluck('name', 'id');

        return [
                Layout::block(Layout::rows([        
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
                    // Layout::view('admin.components.image', ['imagePath' => $this->news->img_path]),
                ]))
                ->title(__('News Information'))
                ->description(__('Update your news\'s information.'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::BASIC)
                        ->icon('bs.check-circle')
                        ->canSee($this->news->exists)
                        ->method('save')
                ),
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(News $news, Request $request)
    {
        $request->validate([
            'news.published_date' => 'required',
            'news.title' => 'required|max:255',
            'news.desc' => 'required|max:1000',
            'news.img_path' => 'required',
        ]);
        // dd($news);
        // $path = $request->input('news.img_path');
        // dd($request->all(), $request->file('news.img_path'));

        // Retrieve the attachment using the ID and get the file path
        // $attachmentId = $request->input('news.img_path');
        // $attachment = \Orchid\Attachment\Models\Attachment::where('id', $attachmentId)->first();

        // // Get the full URL for local storage
        // if ($attachment) {
        //     $path = $attachment->path.$attachment->name.".".$attachment->extension;
        //     $path = asset('storage/' . $path);
        // } else {
        //     $path = null;
        // }

        // $disk = $attachment->getAttribute('disk') ?? 'default';
        // $path = Storage::disk($disk)->url($attachment->path);      

        // $news = new News();
        $news->published_date = $request->input('news.published_date');
        $news->title = $request->input('news.title');
        $news->desc = $request->input('news.desc');
        $news->url = $request->input('news.url');
        $news->img_path = $request->input('news.img_path')[0];
        $news->cate_id = $request->input('news.cate_id');
        $news->save();

        Toast::info(__('News was saved.'));

        return redirect()->route('platform.news');
    }

    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(News $news)
    {
        $news->delete();

        Toast::info(__('News was removed'));

        return redirect()->route('platform.news');
    }
}
