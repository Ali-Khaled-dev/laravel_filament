<?php

namespace App\Filament\Resources\ArticalResource\Pages;

use App\Filament\Resources\ArticalResource;
use App\Filament\Traits\RedirectUrlTrait;
use App\Filament\Traits\Translatable;
use Filament\Resources\Pages\EditRecord;

class EditArtical extends EditRecord
{
    use Translatable,RedirectUrlTrait;
    protected static string $resource = ArticalResource::class;
}
