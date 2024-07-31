<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\Review;
use App\Models\Slug;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('Users', User::count())->label(__('Users'))->chart([0, User::count(), 0, User::count()])->color('info'),

        ];
    }
}
