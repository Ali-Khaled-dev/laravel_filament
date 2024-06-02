<?php

namespace App\Models;

use App\Filament\Traits\InputsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;

class Post extends Model implements TranslatableContract, HasMedia
{
    use HasFactory, Translatable, SoftDeletes, InteractsWithMedia,InputsTrait;
    public $fillable   = [
        'thumbanil',
        'tags',
        'slug',
        'published',
    ];

    protected $appends = [
        'image',
        'thumb',
        'avatar',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public $translatedAttributes = ['title', 'content'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('posts');

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

    public function reviews()
    {

        return $this->hasMany(Review::class);
    }

    public function category()
    {

        return $this->belongsTo(CategoryTranslation::class);
    }

    public function comments()
    {

        return $this->morphMany(Comment::class, 'commentable');
    }

    public function authors()
    {

        return $this->belongsToMany(Artical::class, 'post_users')->withTimestamps();
    }
    // public function user(){

    // }

    public static function getForm()
    {

        return [
            Section::make()
                ->schema([
                    Tabs::make('Tabs')
                        ->tabs(fn () => array_map(

                            fn ($language, $locale) => Tabs\Tab::make($language['native'])->schema([

                                InputsTrait::input(
                                    $locale . '.title',
                                    __('Title') . ' (' . $language['native'] . ')',
                                    __('Enter Title'),
                                    'heroicon-m-language'
                                )->maxLength(50)->columns(6),

                                InputsTrait::markEditor($locale . '.content', __('Content') . ' (' . $language['native'] . ')')

                            ]),
                            LaravelLocalization::getLocalesOrder(),
                            array_keys(LaravelLocalization::getLocalesOrder())
                        ))->columnSpan(1),

                    Section::make(__('Secondary information'))->schema([

                        InputsTrait::imageUpload('posts'),
                        InputsTrait::input('slug', __('Slug'), __('Enter Slug'), 'heroicon-m-link'),
                        InputsTrait::tags('tags', __('Tags'), __('Enter Tags'), 'heroicon-m-tag'),
                        InputsTrait::checkBox('published', __('published')),
                        InputsTrait::select('authors', __('Authors'), 'authors', 'name'),

                    ])->columns(1)->columnSpan(1),

                ])->columns(2),
        ];
    }
}
