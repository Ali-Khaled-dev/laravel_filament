<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Spatie\Permission\Models\Role;

class CountModels extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(__('Users'), User::count())
                ->description(__('Users OF Number'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make(__('Roles'), Role::count())
                ->description(__('Roles Of Number'))
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make(__('Categories'), Category::count())
                ->description(__('Category Of Number'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make(__('Articals'), Article::count())
                ->description(__('Articals Of Number'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('danger'),
            Stat::make(__('Authors'), Author::count())
                ->description(__('Authors Of Number'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make(__('Tags'), Tag::count())
                ->description(__('Tags Of Number'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('danger'),
        ];
    }
}
