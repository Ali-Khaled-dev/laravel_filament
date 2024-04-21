<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Review;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PostsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Categories',Category::count())->label(__('Categories'))->chart([0,2,5,2,5,0])->color('info'),
            Stat::make('Posts',Post::count())->label(__('Posts'))->chart([0,2,5,2,5,0])->color('info'),
            Stat::make('Comment',Comment::count())->label(__('Comments'))->chart([0,2,5,2,5,0])->color('info'),

        ];
    }
}
