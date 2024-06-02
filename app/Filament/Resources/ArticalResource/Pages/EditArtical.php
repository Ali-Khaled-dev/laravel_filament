<?php

namespace App\Filament\Resources\ArticalResource\Pages;

use App\Filament\Resources\ArticalResource;
use App\Filament\Traits\RedirectUrlTrait;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArtical extends EditRecord
{
    use RedirectUrlTrait;
    protected static string $resource = ArticalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
