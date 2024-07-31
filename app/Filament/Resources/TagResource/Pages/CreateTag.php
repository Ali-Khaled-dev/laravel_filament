<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;

use App\Filament\Traits\RedirectUrlTrait;
use Filament\Resources\Pages\CreateRecord;

class CreateTag extends CreateRecord
{
    use RedirectUrlTrait;
    protected static string $resource = TagResource::class;
}
