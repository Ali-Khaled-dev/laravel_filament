<?php

namespace App\Filament\Resources\WidgetResource\Pages;

use App\Filament\Resources\WidgetResource;

use Filament\Resources\Pages\ListRecord;
use Filament\Resources\Pages\ListRecords;

class ListWidget extends ListRecords
{
    protected static string $resource = WidgetResource::class;
}
