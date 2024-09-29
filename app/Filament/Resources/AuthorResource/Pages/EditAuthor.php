<?php

namespace App\Filament\Resources\AuthorResource\Pages;

use App\Filament\Resources\AuthorResource;
use App\Filament\Traits\RedirectUrlTrait;
use Filament\Resources\Pages\EditRecord;

class EditAuthor extends EditRecord
{
    use RedirectUrlTrait;
    protected static string $resource = AuthorResource::class;
}
