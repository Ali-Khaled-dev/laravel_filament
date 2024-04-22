<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\App;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mockery\Matcher\Closure;
use Illuminate\Support\Str;
class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';
    
    public static function form(Form $form): Form
    {
        
        return  $form->schema(Category::getForm());
  
    }

    public static function table(Table $table): Table
    { 
        return $table
            ->columns([
                    TextColumn::make('name')
                    ->translateLabel(),
                    TextColumn::make('created_at')
                    ->date()
                    ->label(__('Date')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->modalHeading(fn ($record) => $record->translateOrDefault()?->name ),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function getPluralModelLabel(): string
    {
        return __('Categories');
    }

    public static function getModelLabel(): string
    {
        return __('Category');
    }    
   
    public static function getNavigationBadge(): ?string
    {
        return Category::count();
           
    }

}