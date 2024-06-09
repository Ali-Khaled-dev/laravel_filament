<?php


namespace App\Filament\Resources;

use App\Filament\Resources\GridResource\Pages;
use App\Models\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;


class GridResource extends Resource
{
    protected static ?string $model = Grid::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(1)
                    ->searchable(1),
                Tables\Columns\TextColumn::make('name')
                    ->sortable(1)
                    ->searchable(1),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGrid::route('/'),
            'create' => Pages\CreateGrid::route('/create'),
            'edit' => Pages\EditGrid::route('/{record}/edit'),
        ];
    }
}