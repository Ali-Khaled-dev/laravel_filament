<?php

namespace App\Models;

use App\Filament\Traits\InputsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Filament\Forms\Set;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable;


    public $translatedAttributes = [
        'locale',
        'name',
        'slug',
        'meta_descreption',
        'meta_keywords',
    ];

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
                        ->tabs(fn() => array_map(
                            fn($language, $locale) => Tabs\Tab::make($language['native'])->schema([
                                Section::make()->schema([
                                    InputsTrait::input(
                                        $locale . '.name',
                                        __('Name') . '(' . $language['native'] . ')',
                                        __('Enter Name'),
                                        'heroicon-m-language'
                                    )
                                        ->maxLength(50)->live(onBlur: true)
                                        ->afterStateUpdated(function (Set $set, string $state) use ($locale) {
                                            $set($locale . '.slug', InputsTrait::formatText($state));
                                        }),

                                    InputsTrait::input(
                                        $locale . '.slug',
                                        __('Slug') . '(' . $language['native'] . ')',
                                        __('Enter Slug'),
                                        'heroicon-m-language'
                                    )->readOnly(),

                                ])->columnSpan(2),

                                Section::make('meta')->label('Meta')->schema([

                                    InputsTrait::tags(
                                        $locale . '.meta_descreption',
                                        __('Meta Descreption') . '(' . $language['native'] . ')',
                                        __('Enter Name'),
                                        'heroicon-m-language'
                                    ),
                                    InputsTrait::tags(
                                        $locale . '.meta_keywords',
                                        __('Meta KeyWords') . '(' . $language['native'] . ')',
                                        __('Enter Name'),
                                        'heroicon-m-language'
                                    ),
                                ])->columnSpan(2),
                            ]),


                            LaravelLocalization::getLocalesOrder(),
                            array_keys(LaravelLocalization::getLocalesOrder())
                        ))->columns(4),
                ]),
        ];
    }
}
