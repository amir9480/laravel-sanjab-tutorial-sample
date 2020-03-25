<?php

namespace App\Http\Controllers\Admin\Crud;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Sanjab\Controllers\CrudController;
use Sanjab\Helpers\CrudProperties;
use Sanjab\Helpers\MaterialIcons;
use Sanjab\Widgets\File\UppyWidget;
use Sanjab\Widgets\IdWidget;
use Sanjab\Widgets\ItemListWidget;
use Sanjab\Widgets\MoneyWidget;
use Sanjab\Widgets\Relation\BelongsToPickerWidget;
use Sanjab\Widgets\TextAreaWidget;
use Sanjab\Widgets\TextWidget;
use Sanjab\Widgets\Wysiwyg\QuillWidget;

class ProductController extends CrudController
{
    protected static function properties(): CrudProperties
    {
        return CrudProperties::create('products')
                ->model(\App\Product::class)
                ->title("محصول")
                ->titles("محصولات")
                ->icon(MaterialIcons::SHOPPING_CART);
    }

    protected function init(string $type, Model $item = null): void
    {
        $this->widgets[] = IdWidget::create();

        $this->widgets[] = TextWidget::create('name', 'نام')
                            ->required()
                            ->cols(6);

        $this->widgets[] = BelongsToPickerWidget::create('category', 'دسته بندی')
                            ->required()
                            ->format('%id - %name')
                            ->query(function (Builder $query) {
                                $query->whereDoesntHave('subCategories');
                            })
                            ->cols(6)
                            ->ajax(true);

        $this->widgets[] = MoneyWidget::create('price', 'قیمت')
                            ->rules('required|min:1000')
                            ->precision(0)
                            ->postfix(' تومان');

        $this->widgets[] = UppyWidget::image('image', 'عکس اصلی')
                            ->required()
                            ->height(600);

        $this->widgets[] = UppyWidget::image('images', 'تصاویر')
                            ->multiple()
                            ->nullable();

        $this->widgets[] = TextAreaWidget::create('description', 'توضیحات')
                            ->required();

        $this->widgets[] = QuillWidget::create('content', 'محتوا')
                            ->required();

        $this->widgets[] = ItemListWidget::create('features', 'ویژگی ها')
                            ->nullable()
                            ->addWidget(TextWidget::create('name', 'نام ویژگی')->required()->cols(6))
                            ->addWidget(TextWidget::create('value', 'مقدار ویژگی')->required()->cols(6));


    }
}
