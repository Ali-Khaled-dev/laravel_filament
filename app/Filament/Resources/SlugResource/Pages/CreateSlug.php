<?php

namespace App\Filament\Resources\SlugResource\Pages;

use App\Filament\Resources\SlugResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSlug extends CreateRecord
{
    protected static string $resource = SlugResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
