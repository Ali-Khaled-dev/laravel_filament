<?php

namespace App\Filament\Traits;
use Illuminate\Database\Eloquent\Builder;
trait Translatable
{
    protected function fillForm(): void
    {
        $this->callHook('beforeFill');

        $data = $this->getRecord()->attributesToArray();

        foreach (static::getRecord()->getTranslationsArray() as $key => $value) {
            $data[$key] = $value;
        }

        $data = $this->mutateFormDataBeforeFill($data);

        $this->form->fill($data);

        $this->callHook('afterFill');
    }
    // This override get SQL optimization and get all translations
    protected function getTableQuery(): Builder
    {
        return static::getResource()::getEloquentQuery()->with('translations');
    }
}