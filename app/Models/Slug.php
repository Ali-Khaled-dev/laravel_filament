<?php

namespace App\Models;

use App\Filament\Traits\InputsTrait;
use Doctrine\DBAL\Query\Limit;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use PhpParser\Node\Stmt\Static_;

class Slug extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'slug', 'photo'];


    
    public function category() 
    {
      
        return $this->belongsTo(Category::class);
    
    }

    public static function getForm() 
    {
        return [
            Section::make()
            ->schema([
                Section::make()->schema([
                    Tabs::make('Tabs')
                    ->tabs(fn () => array_map(  
                        fn ($language, $locale) => Tabs\Tab::make($language['native'])->schema([

                            // InputsTrait::select('category_id',__('Title'),'category','name:' . $locale),
                            Select::make('category_id')
                            ->label(__('Title'))
                            ->searchable()
                            ->preload()
                            ->options(Category::all()->pluck('name:' . $locale, 'id'))
                            ->required()
                           ->optionsLimit(3)
                             ]),
                                LaravelLocalization::getLocalesOrder(),
                                 array_keys(LaravelLocalization::getLocalesOrder())
                            ))->columnSpan(1),
              
                        ]),
                        
                       Section::make('')->schema([
                        TextInput::make('slug')
                        ->translateLabel()
                        ->required(),

                        FileUpload::make('photo')
                        ->hintIcon('heroicon-m-question-mark-circle', tooltip: '320*230')
                        ->translateLabel()
                        ->disk('public')
                        ->directory('photos')
                        ->required(),
                        
                       ])->columns(2)
            

            ]),
        ];
    }
}
