<?php

namespace App\Filament\Resources\CommentResource\Pages;

use App\Filament\Resources\CommentResource;
use App\Filament\Traits\RedirectUrlTrait;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateComment extends CreateRecord
{
  use RedirectUrlTrait;
    protected static string $resource = CommentResource::class;

  
}
