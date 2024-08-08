<?php

namespace App\Models;

use App\Filament\Traits\InputsTrait;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Tag extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $translatedAttributes = ['name'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function articals()
    {
        return $this->belongsToMany(Artical::class, 'artical_tag');
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
