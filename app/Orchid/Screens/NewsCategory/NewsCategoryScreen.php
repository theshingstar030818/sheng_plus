<?php
namespace App\Orchid\Screens\NewsCategory;

use App\Models\NewsCategory;
use Illuminate\Http\Request;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Button;

class NewsCategoryScreen extends Screen
{
    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'News Category';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'Categories for News';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Add Category')
                ->modal('NewsCategoryModal')
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
        return [
            'news_categories' => NewsCategory::latest()->get(),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('news_categories', [
                TD::make('name'),
                TD::make('Actions')
                ->alignRight()
                ->render(function (NewsCategory $news_category) {
                    return Button::make('Delete')
                        ->confirm('After deleting, the news category will be gone forever.')
                        ->method('delete', ['news_category' => $news_category->id]);
                }),
            ]),

            Layout::modal('NewsCategoryModal', Layout::rows([
                Input::make('news_category.name')
                    ->title('Name')
                    ->placeholder('Enter New Category name')
                    ->help('The name of the New Category to be created.'),
            ]))
                ->title('Create New Category')
                ->applyButton('Add New Category'),
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function create(Request $request)
    {
        // Validate form data, save news category to database, etc.
        $request->validate([
            'news_category.name' => 'required|max:255',
        ]);

        $new_category = new NewsCategory();
        $new_category->name = $request->input('news_category.name');
        $new_category->save();
    }

    /**
     * @param NewsCategory $news_category
     *
     * @return void
     */
    public function delete(NewsCategory $news_category)
    {
        $news_category->delete();
    }
}
