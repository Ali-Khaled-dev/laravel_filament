<?php

namespace App\Filament\Resources\SlugResource\RelationManagers;

use App\Filament\Traits\InputsTrait;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CategoryRelationManager extends RelationManager
{
    protected static string $relationship = 'category';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs(fn () => array_map(
                        fn ($language, $locale) => Tabs\Tab::make($language['native'])->schema([
                            InputsTrait::input(
                                $locale . '.name',
                                __('Name') . '(' . $language['native'] . ')',
                                __('Enter Name'),
                                'heroicon-m-language'
                            )
                                ->maxLength(50),
                        ]),

                        LaravelLocalization::getLocalesOrder(),
                        array_keys(LaravelLocalization::getLocalesOrder())
                    ))
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
