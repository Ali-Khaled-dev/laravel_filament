<?php


namespace App\Filament\Resources;

use App\Filament\Resources\ArticalResource\Pages;
use App\Models\Artical;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;


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
                    ->sortable()
                    ->searchable(),
                TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('meta_keywords')
                    ->sortable()
                    ->searchable(),



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
