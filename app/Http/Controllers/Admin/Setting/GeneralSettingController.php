<?php

namespace App\Http\Controllers\Admin\Setting;

use Sanjab\Controllers\SettingController;
use Sanjab\Helpers\SettingProperties;
use Sanjab\Widgets\File\UppyWidget;
use Sanjab\Widgets\TextWidget;

class GeneralSettingController extends SettingController
{
    protected static function properties(): SettingProperties
    {
        return SettingProperties::create('general')
            ->title('تنظیمات عمومی');
    }

    protected function init(): void
    {
        $this->widgets[] = TextWidget::create('site_name', 'نام سایت')
                            ->required();

        $this->widgets[] = UppyWidget::image('image', 'عکس سایت')
                            ->width(256)
                            ->height(256)
                            ->required();
    }
}
