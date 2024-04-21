<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Faker\Provider\ar_EG\Text;
use Filament\Actions;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\SpatieLaravelTranslatablePlugin;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CreateCategory extends CreateRecord
{
    
    protected static string $resource = CategoryResource::class;
    protected ?bool $hasDatabaseTransactions = true;
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return __('A new category has been added');
    }
}
