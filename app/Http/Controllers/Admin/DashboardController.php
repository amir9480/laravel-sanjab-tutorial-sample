<?php

namespace App\Http\Controllers\Admin;

use Sanjab;
use Sanjab\Controllers\DashboardController as SanjabDashboardController;
use Sanjab\Helpers\DashboardProperties;

class DashboardController extends SanjabDashboardController
{
    protected static function properties(): DashboardProperties
    {
        return DashboardProperties::create()
                ->title(trans('sanjab::sanjab.dashboard'));
    }

    protected function init(): void
    {
        $this->cards = Sanjab::dashboardCards();
    }
}
