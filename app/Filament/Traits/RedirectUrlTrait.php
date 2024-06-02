<?php

namespace App\Filament\Traits;


trait RedirectUrlTrait{

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');

    }
}
