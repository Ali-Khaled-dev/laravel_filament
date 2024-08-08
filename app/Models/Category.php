<?php

namespace App\Models;

use App\Filament\Traits\InputsTrait;
use App\Filament\Traits\RedirectUrlTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable;


    public $translatedAttributes = ['name'];

    public function articals()
    {

        return $this->hasMany(Artical::class);
    }

    public static function getForm()
    {

        return [
            Section::make()
                ->schema([

                    Tabs::make('Tabs')
                        ->tabs(fn () => array_map(
                            fn ($language, $locale) => Tabs\Tab::make($language['native'])->schema([
                                InputsTrait::input(
                                    $locale . '.name',
                                    __('Name') . '(' . $language['native'] . ')',
                                    __('Enter Name'),
                                    'heroicon-m-language'
                                )
                                    ->maxLength(50),
                            ]),

                            LaravelLocalization::getLocalesOrder(),
                            array_keys(LaravelLocalization::getLocalesOrder())
                        ))->columnSpanFull(),
                ]),
        ];
    }
}
