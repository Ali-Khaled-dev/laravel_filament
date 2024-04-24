<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Filament\Traits\RedirectUrlTrait;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
  use RedirectUrlTrait;  
    protected static string $resource = CategoryResource::class;
    protected ?bool $hasDatabaseTransactions = true;
  

    protected function getCreatedNotificationTitle(): ?string
    {
        return __('A new category has been added');
    }
}
