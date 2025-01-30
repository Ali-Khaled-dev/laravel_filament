<?php

namespace App\Models;

use App\Filament\Traits\InputsTrait;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Author extends Model implements HasMedia
{
    use HasFactory, InputsTrait, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'meta_descreption',
    ];

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
        return $this->belongsToMany(Article::class, 'artical_author');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('authors');

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


    public static function getForm()
    {
        return [
            Section::make()
                ->schema([
                    Section::make('')->schema([

                        InputsTrait::input('name', __('Name')),
                        InputsTrait::input('meta_descreption', __('Meta Descreption')),

                    ])->columnSpan(2),

                    Section::make()->schema([
                        InputsTrait::imageUpload('authors'),
                    ])->columnSpan(1),
                ])->columns(3),

        ];
    }
}
