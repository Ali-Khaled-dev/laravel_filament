<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema(Article::getForm());
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable()
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('Image'))
                    ->conversion('public')
                    ->collection('articals')
                    ->square()
                    ->height(75),
                TextColumn::make('title')
                    ->label(__('Title'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('authors.name')->label(__('Author')),
                TextColumn::make('created_at')->label(__('Date'))->date()
            ])
            ->filters([
                //
            ])->paginated([5, 10, 25, 50])
            ->actions([
                Tables\Actions\DeleteAction::make()->modalHeading(fn($record) => $record->translateOrDefault()?->title),
                Tables\Actions\ForceDeleteAction::make()->modalHeading(fn($record) => $record->translateOrDefault()?->title),
                Tables\Actions\RestoreAction::make()->modalHeading(fn($record) => $record->translateOrDefault()?->title),
                Tables\Actions\ViewAction::make()->modalHeading(fn($record) => $record->translateOrDefault()?->title),
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
    public static function getPluralModelLabel(): string
    {
        return __('Articles');
    }

    public static function getModelLabel(): string
    {
        return __('Article');
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
