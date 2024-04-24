<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Resources\ReviewResource;
use App\Filament\Traits\RedirectUrlTrait;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReview extends CreateRecord
{
    use RedirectUrlTrait;
    protected static string $resource = ReviewResource::class;
   
}
