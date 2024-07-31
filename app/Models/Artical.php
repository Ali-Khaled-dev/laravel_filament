<?php

namespace App\Models;

use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Traits\InputsTrait;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Set;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Image\Manipulations;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Artical extends Model implements TranslatableContract, HasMedia
{
    use HasFactory, Translatable, InteractsWithMedia;


    public $fillable = [
        'tag_id'
    ];


    public $translatedAttributes = [
        'title',
        'slug',
        'short_descreption',
        'descreption',
        'meta_keywords',
    ];


    protected $casts = [
        'id' => 'integer',
        'meta_keywords' => 'array',
        'tag_id' => 'array'

    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('articals');

        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 900, 420)
            ->nonQueued();

        $this->addMediaConversion('avatar')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();

        $this->addMediaConversion('small_wide')
            ->fit(Manipulations::FIT_CROP, 360, 139)
            ->nonQueued();
    }

    public function getImageAttribute(): string|null
    {
        $media = $this->getMedia('default')->first();
        $url = ($media) ? $media->getUrl() : null;
        return $url;
    }

    public function getThumbAttribute(): string|null
    {
        $media = $this->getMedia('default')->first();
        $url = ($media) ? $media->getUrl('thumb') : null;
        return $url;
    }

    public function getAvatarAttribute(): string|null
    {
        $media = $this->getMedia('default')->first();
        $url = ($media) ? $media->getUrl('avatar') : null;
        return $url;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'artical_tag');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'artical_author');
    }


    public static function getForm()
    {
        return [
            Section::make()->schema([
                // InputsTrait::imageUpload('articals'),
                Tabs::make('Tabs')
                    ->tabs(fn () => array_map(
                        fn ($language, $locale) => Tabs\Tab::make($language['native'])->schema([

                            InputsTrait::input(
                                $locale . '.title',
                                __('Title') . '(' . $language['native'] . ')',
                                __('Enter Title'),
                                'heroicon-m-language'
                            )->maxLength(50)
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (Set $set, string $state) use ($locale) {
                                    $set($locale . '.slug', InputsTrait::formatText($state));
                                }),

                            InputsTrait::input(
                                $locale . '.slug',
                                __('Slug') . '(' . $language['native'] . ')',
                                __('Enter Slug'),
                                'heroicon-m-language'
                            )->maxLength(50),


                            InputsTrait::input($locale . '.short_descreption', __('Short Descreption') . ' (' . $language['native'] . ')'),

                            InputsTrait::markEditor($locale . '.descreption', __('Descreption') . ' (' . $language['native'] . ')'),

                            InputsTrait::select('tag_id', __('Tags'))->relationship('tags', 'name')->options(Tag::all()->pluck('name:' . $locale, 'id'))->multiple(),
                            //
                            InputsTrait::tags($locale . '.meta_keywords', __('Meta keywords') . ' (' . $language['native'] . ')'),
                        ]),

                        LaravelLocalization::getLocalesOrder(),
                        array_keys(LaravelLocalization::getLocalesOrder())
                    )),


                InputsTrait::select('authors', __('Authors'))->relationship('authors', 'name')->options(Author::all()->pluck('name', 'id')),


            ])->columns(2),

        ];
    }
}
