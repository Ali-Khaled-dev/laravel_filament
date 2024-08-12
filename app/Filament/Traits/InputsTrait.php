<?php

namespace App\Filament\Traits;

use Blueprint\Contracts\Model;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Filament\Forms\Components\Actions\Action;

trait InputsTrait
{

    public static function imageUpload(string $collection)
    {

        return SpatieMediaLibraryFileUpload::make('image')
            ->label(__('Image'))
            ->placeholder(__("Drag & Drop your image or <span class='filepond--label-action' tabindex='0'> Browse </span>"))
            ->hintIcon('heroicon-o-information-circle')
            ->hintColor('secondary')
            ->hintIconTooltip(__('Recommended dimensions: 900x420'))
            ->image()
            ->collection($collection)
            ->imageEditor()
            ->imageCropAspectRatio('1:1')
            ->panelAspectRatio('1:1')
            ->panelLayout('compact')
            ->conversion('thumb')
            ->required()->columns(2)
            ->imagePreviewHeight(75)
            ->validationMessages([
                'required' => __('The :attribute required.'),
            ])
            ->removeUploadedFileButtonPosition('right')
            ->maxSize(1024);
    }

    public static function input(string $make, string $label, string $placeholder = null, $icon = null)
    {

        return TextInput::make($make)
            ->label($label)
            ->placeholder($placeholder)
            ->hintIcon($icon)
            ->required()
            ->validationMessages([
                'required' => __('The :attribute required.'),
            ]);
    }

    public static function select(string $make, $label = null, string $relation_name = null, string $relation_column = null)
    {

        return  Select::make($make)
            ->label($label)
            // ->relationship($relation_name, $relation_column)
            ->searchable()
            ->optionsLimit(3)
            ->getOptionLabelsUsing(fn(array $values): array => $this::whereIn('id', $values)->pluck('name', 'id')->toArray())
            ->preload()
            ->required()
            ->validationMessages([
                'required' => __('The :attribute required.'),
            ])->createOptionAction(
                fn(Action $action) => $action->modalWidth('3xl')
            )

            ->createOptionForm(
                [

                    TextInput::make($make)->label($label)
                        ->required(),
                ]
            );
    }



    public static function markEditor(string $make, string $label)
    {

        return MarkdownEditor::make($make)
            ->label($label)
            ->required()
            ->validationMessages([
                'required' => __('The :attribute required.'),
            ]);
    }

    public static function checkBox(string $make, string $label)
    {

        return Checkbox::make($make)
            ->label($label)
            ->required()
            ->validationMessages([
                'required' => __('The :attribute required.'),
            ]);
    }

    public static function tags(string $make, string $label, string $place_holder = null, $icon = null)
    {
        return TagsInput::make($make)
            ->label($label)
            ->placeholder($place_holder)
            ->hintIcon($icon)
            ->required()
            ->validationMessages([
                'required' => __('The :attribute required.'),
            ]);
    }

    static function formatText($text)
    {
        $str_preg = ['/', '.', '(?=[A-Z])', '/u', ' '];

        $formattedText = str_replace($str_preg, '-', $text);

        return $formattedText;
    }
}
