<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Filament\Traits\RedirectUrlTrait;
use App\Filament\Traits\Translatable;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    use Translatable ,RedirectUrlTrait;
    protected static string $resource = CategoryResource::class;
    
}
