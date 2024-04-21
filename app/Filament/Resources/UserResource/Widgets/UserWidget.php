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

        Stat::make('Users',User::count())->label(__('Users'))->chart([0,User::count(),0,User::count()])->color('info'),
        Stat::make('Slugs',Slug::count())->label(__('Slugs'))->chart([0,Slug::count(),0,Slug::count()])->color('info'),
        Stat::make('Review',Review::count())->label(__('Reviews'))->chart([0,Review::count(),5,Review::count(),0])->color('info'),
       
    ];
    }
}
