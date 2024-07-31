<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Models\Category;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PostsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Categories',Category::count())->label(__('Categories'))->chart([0,2,5,2,5,0])->color('info'),

        ];
    }
}
