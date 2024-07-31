<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;

use App\Filament\Traits\RedirectUrlTrait;
use App\Filament\Traits\Translatable;
use Filament\Resources\Pages\EditRecord;

class EditTag extends EditRecord
{
    use Translatable, RedirectUrlTrait;
    protected static string $resource = TagResource::class;
}
