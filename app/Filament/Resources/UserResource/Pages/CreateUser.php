<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Filament\Traits\RedirectUrlTrait;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    use  RedirectUrlTrait;
    protected static string $resource = UserResource::class;



    protected function getCreatedNotificationTitle(): ?string
    {
        return __('A new user has been added');
    }
}
