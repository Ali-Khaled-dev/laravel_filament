<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Category extends Model implements TranslatableContract
{
    use HasFactory;
    
    use Translatable;

    public $fillable = ['slug'];
  
   public $translatedAttributes = ['name'];


   public function posts()  
   {
    
    return $this->hasMany(Post::class);
   
   }

   public static function getForm() {

    return [
        Section::make()
        ->schema([
            Tabs::make('Tabs')
            ->tabs(fn () => array_map(
                fn ($language, $locale) => Tabs\Tab::make($language['native'])->schema([
                    TextInput::make($locale . '.name')
                        ->label(__('Name') . ' (' . $language['native'] . ')')
                        ->placeholder(__('Enter Name'))
                        ->hintIcon('heroicon-m-language')
                        ->required()
                        ->maxLength(50)
                        
                ]),
                LaravelLocalization::getLocalesOrder(),
                array_keys(LaravelLocalization::getLocalesOrder())
            ))->columnSpanFull(),
        ]),
       ];    
}


}
