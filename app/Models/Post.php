<?php

namespace App\Models;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TagsInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements TranslatableContract, HasMedia
{
    use HasFactory, Translatable, SoftDeletes , InteractsWithMedia;
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
    
        return $this->morphMany(Comment::class,'commentable');
    
    }

    public function authors()
    {

        return $this->belongsToMany(User::class,'post_users')->withTimestamps();
    
    }

    public static function getForm() {
       
        return [
            Section::make()
            ->schema([
                Tabs::make('Tabs')
                        ->tabs(fn () => array_map(
                            fn ($language, $locale) => Tabs\Tab::make($language['native'])->schema([
                                
                                TextInput::make($locale . '.title')
                                    ->label(__('Title') . ' (' . $language['native'] . ')')
                                    ->placeholder(__('Enter Title'))
                                    ->hintIcon('heroicon-m-language')
                                    ->required()
                                    ->maxLength(50)
                                    ->columns(6),
        
                                MarkdownEditor::make($locale .'.content')
                                ->label(__('Content' ) . ' (' . $language['native'] . ')')
                                ->required(), 
                                ]),
                                    LaravelLocalization::getLocalesOrder(),
                                     array_keys(LaravelLocalization::getLocalesOrder())
                                ))->columnSpan(1),
                                Section::make(__('Secondary information'))->schema([
        
                                    SpatieMediaLibraryFileUpload::make('image')
                                    ->label(__('Image'))
                                    ->image()
                                    ->conversion('thumb')
                                    ->required()
                                    ->removeUploadedFileButtonPosition('right')
                                    ->maxSize(1024)
                                    ->collection('posts')
                                    // ->placeholder(_("Drag & Drop your image or <span class='filepond--label-action' tabindex='0'> Browse </span>"))
                                    ->hintIcon('heroicon-o-information-circle')
                                    ->hintColor('secondary')
                                    ->hintIconTooltip(__('Recommended dimensions: 900x420'))
                                    ->imageEditor()
                                    ->imageCropAspectRatio('1:1')
                                    ->panelAspectRatio('1:1')
                                    ->panelLayout('compact'),
        
                                    TextInput::make('slug')
                                        ->label(__('Slug'))
                                        ->label(__('Slug'))
                                        ->placeholder(__('Enter Slug'))
                                        ->hintIcon('heroicon-m-link')
                                        ->required(),
        
                                     TagsInput::make('tags')
                                         ->label(__('Tags'))
                                         ->color('danger')
                                         ->required(),
         
                                   
                                     Checkbox::make('published')->label(__('published')),
                                     Select::make('author')
                                         ->label(__('Authors'))
                                         ->relationship('authors','name'),
                                        
                                ])->columns(1)->columnSpan(1),
                               
                 ])->columns(2),
           ];    
   }

}
