<?php

namespace App\Models;

use App\Filament\Traits\InputsTrait;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['post_id','review'];

    public function post() {

        return $this->belongsTo(Post::class);
    }

    public static function getForm() {

        return [
            Section::make()
            ->schema([
                Section::make()->schema([
                    Tabs::make('Tabs')
                    ->tabs(fn () => array_map(
                        fn ($language, $locale) => Tabs\Tab::make($language['native'])->schema([  
                            Select::make('post_id')
                            ->label(__('Title'))
                            ->options(Post::all()->pluck('title:' . $locale, 'id'))
                            ->required(),
                            ]),
                                LaravelLocalization::getLocalesOrder(),
                                 array_keys(LaravelLocalization::getLocalesOrder())
                            ))->columnSpan(1),
                    
                            InputsTrait::input('review',__('Review')),
               
                ]),         
            ]),
        ];    
    }
}
