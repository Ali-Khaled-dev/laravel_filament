<?php

namespace App\Filament\Traits;

use Filament\Actions\DeleteAction;

trait RedirectUrlTrait{

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    
    }

     protected function getHeaderAction()
    {
        
            DeleteAction::make();
    
    }

}