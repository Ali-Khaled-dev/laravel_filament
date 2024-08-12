<?php


namespace App\Filament\Resources;

use App\Filament\Resources\ArticalResource\Pages;
use App\Models\Artical;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class ArticalResource extends Resource
{
    protected static ?string $model = Artical::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form->schema(Artical::getForm());
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
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([

                    Tables\Actions\DeleteAction::make()->modalHeading(fn ($record) => $record->translateOrDefault()?->title),
                    Tables\Actions\ForceDeleteAction::make()->modalHeading(fn ($record) => $record->translateOrDefault()?->title),
                    Tables\Actions\RestoreAction::make()->modalHeading(fn ($record) => $record->translateOrDefault()?->title),
                    Tables\Actions\ViewAction::make()->modalHeading(fn ($record) => $record->translateOrDefault()?->title),

                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ])
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPluralModelLabel(): string
    {
        return __('Articals');
    }

    public static function getModelLabel(): string
    {
        return __('Artical');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticals::route('/'),
            'create' => Pages\CreateArtical::route('/create'),
            'edit' => Pages\EditArtical::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return Artical::count();
    }
}
