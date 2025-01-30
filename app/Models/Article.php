<?php

namespace App\Models;

use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Traits\InputsTrait;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Set;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements TranslatableContract, HasMedia
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
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'article_author', 'article_id', 'author_id');
    }
    public function Categories()
    {
        return $this->belongsToMany(Category::class, 'category_article');
    }


    public static function getForm()
    {
        return [
            Section::make()->schema([

                Tabs::make('Tabs')
                    ->tabs(fn() => array_map(
                        fn($language, $locale) => Tabs\Tab::make($language['native'])->schema([

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
                            )->readOnly(),

                            InputsTrait::input($locale . '.short_descreption', __('Short Descreption') . ' (' . $language['native'] . ')'),

                            InputsTrait::select('tag_id', __('Tags'))->relationship('tags', 'name')->options(Tag::all()->pluck('name:' . $locale, 'id'))->multiple(),

                            InputsTrait::tags($locale . '.meta_descreption', __('Meta Descreption') . ' (' . $language['native'] . ')'),

                            InputsTrait::markEditor($locale . '.descreption', __('Descreption') . ' (' . $language['native'] . ')')->columnSpanFull(),
                        ])->columns(2),

                        LaravelLocalization::getLocalesOrder(),
                        array_keys(LaravelLocalization::getLocalesOrder())
                    ))->columnSpan(4),
                Section::make('')->schema(
                    [
                        InputsTrait::imageUpload('articals'),
                        InputsTrait::select('authors', __('Authors'), Author::getForm())->relationship('authors', 'name')->options(Author::all()->pluck('name', 'id')),
                        InputsTrait::select('categories', __('Categories'), Category::getForm())->relationship('categories', 'name')->options(Category::all()->pluck('name', 'id')),

                    ],

                )->columnSpan(2),


            ])->columns(6),

        ];
    }
}
