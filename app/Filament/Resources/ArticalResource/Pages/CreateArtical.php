<?php

namespace App\Filament\Resources\ArticalResource\Pages;

use App\Filament\Resources\ArticalResource;

use App\Filament\Traits\RedirectUrlTrait;
use Filament\Resources\Pages\CreateRecord;

class CreateArtical extends CreateRecord
{
    use RedirectUrlTrait;
    protected static string $resource = ArticalResource::class;
}
