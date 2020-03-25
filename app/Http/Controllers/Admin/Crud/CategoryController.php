<?php

namespace App\Http\Controllers\Admin\Crud;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Sanjab\Controllers\CrudController;
use Sanjab\Helpers\CrudProperties;
use Sanjab\Helpers\MaterialIcons;
use Sanjab\Widgets\FontAwesomeWidget;
use Sanjab\Widgets\IdWidget;
use Sanjab\Widgets\Relation\BelongsToPickerWidget;
use Sanjab\Widgets\TextAreaWidget;
use Sanjab\Widgets\TextWidget;

class CategoryController extends CrudController
{
    protected static function properties(): CrudProperties
    {
        return CrudProperties::create('categories')
                ->model(\App\Category::class)
                ->title("دسته بندی")
                ->titles("دسته بندی ها")
                ->icon(MaterialIcons::STAR);
    }

    protected function init(string $type, Model $item = null): void
    {
        $this->widgets[] = IdWidget::create();

        $this->widgets[] = TextWidget::create('name', 'نام')
                            ->required();

        $this->widgets[] = TextAreaWidget::create('description', 'توضیح')
                            ->nullable()
                            ->description('این فیلد برای سئو است');

        $this->widgets[] = FontAwesomeWidget::create('icon', 'آیکون')
                            ->required();

        $this->widgets[] = BelongsToPickerWidget::create('parentCategory', 'دسته بندی والد')
                            ->nullable()
                            ->format('%id - %name')
                            ->query(function (Builder $query) use ($item) {
                                if ($item != null) {
                                    $query->where('id', '!=', $item->id);
                                }
                            });
    }
}
