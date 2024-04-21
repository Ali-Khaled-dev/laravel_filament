<?php

namespace App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource;
use App\Filament\Traits\RedirectUrlTrait;
use App\Filament\Traits\Translatable;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
     use Translatable, RedirectUrlTrait;
 
     protected static string $resource = PostResource::class;

   
 

}
