<?php

namespace App\Filament\Traits;

use Closure;

trait RedirectUrlTrait{

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    
    }


}