<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SlugResource\Pages;
use App\Filament\Resources\SlugResource\RelationManagers;
use App\Models\Category;
use App\Models\Slug;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Tables\Columns\ImageColumn;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



class SlugResource extends Resource
{
    protected static ?string $model = Slug::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    public static function form(Form $form): Form
    {
        return  $form->schema(Slug::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('photo')
               ->label(__('Image')),

                TextColumn::make('category.name')
                ->label(__('Category')),

                TextColumn::make('slug')
                ->translateLabel(),
            
            ])
            ->filters([
             //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSlugs::route('/'),
            'create' => Pages\CreateSlug::route('/create'),
            'edit' => Pages\EditSlug::route('/{record}/edit'),
        ];
    }

    public static function getPluralModelLabel(): string
    {
        return __('Slugs');
    }

    public static function getModelLabel(): string
    {
        return __('Slug');
    }

    public static function getNavigationBadge(): ?string
    {
        return Slug::count();
           
    }
}