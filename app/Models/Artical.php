<?php

namespace App\Models;

use App\Filament\Traits\InputsTrait;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Artical extends Model implements HasMedia
{
    use HasFactory, InputsTrait, InteractsWithMedia;

    public $fillable = ['name', 'job'];



    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_users')->withTimestamps();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('artical');

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

    static public function getForm()
    {
        return [
            Grid::make(3)->schema([
                Section::make()
                    ->schema([
                        InputsTrait::input('name', 'Name', __('Enter Name'))->translateLabel(),
                        InputsTrait::input('job', 'Job', __('Enter Job'))->translateLabel(),

                    ])->columnSpan(2),
                Section::make()->schema([
                    InputsTrait::imageUpload('artical'),
                ])->columnSpan(1),
            ]),
        ];
    }
}
