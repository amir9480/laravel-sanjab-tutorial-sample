<?php

namespace App\Http\Controllers\Admin\Crud;

use App\User;
use Sanjab\Widgets\IdWidget;
use Sanjab\Widgets\TextWidget;
use Sanjab\Helpers\MaterialIcons;
use Sanjab\Helpers\CrudProperties;
use Sanjab\Widgets\PasswordWidget;
use Sanjab\Controllers\CrudController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Sanjab\Widgets\Relation\BelongsToManyWidget;

class UserController extends CrudController
{
    protected static function properties(): CrudProperties
    {
        return CrudProperties::create('users')
                ->model(User::class)
                ->icon(MaterialIcons::PERSON)
                ->title(trans('sanjab::sanjab.user'))
                ->titles(trans('sanjab::sanjab.users'));
    }

    protected function init(string $type, Model $item = null): void
    {
        $this->widgets[] = IdWidget::create();

        $this->widgets[] = TextWidget::create('first_name', 'نام')
                ->rules('required|string');

        $this->widgets[] = TextWidget::create('last_name', 'نام خانوادگی')
                ->rules('required|string');

        $this->widgets[] = TextWidget::create('mobile', 'شماره همراه')
                ->rules('required|string|mobile|unique:users,mobile,'.optional($item)->id);

        $this->widgets[] = TextWidget::create('email', trans('sanjab::sanjab.email'))
                ->rules('nullable|email|unique:users,email,'.optional($item)->id.',id');

        $this->widgets[] = PasswordWidget::create('password', trans('sanjab::sanjab.password'))
                ->createRules('required')
                ->editRules('nullable')
                ->rules('min:6|confirmed');

        $this->widgets[] = PasswordWidget::create('password_confirmation', trans('sanjab::sanjab.password_confirmation'))
                ->onStore(false);

        $this->widgets[] = BelongsToManyWidget::create('roles', trans('sanjab::sanjab.roles'))
                ->format('%title')
                ->query(function (Builder $query) use ($type) {
                    if ($type != 'show') {
                        $query->where('name', '!=', 'super_admin');
                    }
                });
    }
}
