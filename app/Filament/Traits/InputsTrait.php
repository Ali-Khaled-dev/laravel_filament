<?php

namespace App\Filament\Traits;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;

trait InputsTrait{

    static function ImageUpload($input,$place_holder)
    {
        return  SpatieMediaLibraryFileUpload::make($input)
        ->label(__('Image'))
        ->image()
        ->conversion('thumb')
        ->required()
        ->removeUploadedFileButtonPosition('right')
        ->maxSize(1024)
        ->collection('posts')
        ->placeholder($place_holder)
        ->hintIcon('heroicon-o-information-circle')
        ->hintColor('secondary')
        ->hintIconTooltip(__('Recommended dimensions: 900x420'))
        ->imageEditor()
        ->imageCropAspectRatio('1:1')
        ->panelAspectRatio('1:1')
        ->panelLayout('compact');
    }

    Static function input($make,$input, $placeholder, $icon)
    {
      return  TextInput::make($make)
        ->required()
        ->label($input)
        ->placeholder($placeholder)
        ->hintIcon($icon);
        
    }

    static  function select($make,$input,$relation_name,$relation_column)
    {
        return  Select::make($make)
        ->label(__($input))
        ->relationship($relation_name,$relation_column);
    }



}

