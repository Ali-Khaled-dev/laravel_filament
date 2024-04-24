<?php

namespace App\Filament\Resources;


use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\SlugResource\RelationManagers\CategoryRelationManager;
use App\Models\Post;
use Filament\Forms\Form;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
   
   
    public static function form(Form $form): Form
    {
        return  $form->schema(Post::getForm());
    }
   
    public static function table(Table $table): Table
    {

        return $table 
            ->columns([

                SpatieMediaLibraryImageColumn::make('image')
                ->label(__('Image'))
                ->conversion('public')
                ->collection('posts')
                ->square()
                ->height(75),

                TextColumn::make('title')
                ->label(__('Title'))
                ->sortable()
                ->searchable(),

                CheckboxColumn::make('published')
                ->label(__('published')),

               TextColumn::make('authors.name')
                ->label(__( 'Author' )), 

               TextColumn::make('created_at')
                ->label(__('Date'))
                ->date()
                ->sortable()
                ->searchable()
                ->toggleable(),
        
            ])
            ->filters([
                TernaryFilter::make('Published'), 
                 Tables\Filters\TrashedFilter::make(),
                
            ])
            ->actions([
              Tables\Actions\ActionGroup::make([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->modalHeading(fn ($record) => $record->translateOrDefault()?->title ),
                Tables\Actions\ForceDeleteAction::make()->modalHeading(fn ($record) => $record->translateOrDefault()?->title ),
                Tables\Actions\RestoreAction::make()->modalHeading(fn ($record) => $record->translateOrDefault()?->title ),
                Tables\Actions\ViewAction::make()->modalHeading(fn ($record) => $record->translateOrDefault()?->title ),
             
              ])
              ->icon('heroicon-m-ellipsis-vertical')
              ->size(ActionSize::Small)
              ->color('primary')
              ->button(),
    
            ])
 
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                     Tables\Actions\RestoreBulkAction::make(),
                     Tables\Actions\ForceDeleteBulkAction::make(),
                  
                ]),
            ]) ;
    }
   
    public static function getRelations(): array
    {
        return [
            CategoryRelationManager::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {

        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
        ]);
   
    }

    public static function infoList(Infolist $infolist): Infolist
    {
        
        return $infolist
        ->schema([

            SpatieMediaLibraryImageEntry::make('image')
            ->collection('posts'),

            TextEntry::make('content')
            ->translateLabel(), 

            TextEntry::make('slug')
            ->label(__('Link')),
            
            TextEntry::make('tags')
            ->badge(),

            TextEntry::make('authors.name')
            ->label(__('Author')),

            TextEntry::make('created_at')
            ->date()
            ->label(__('Date')),

        ])->columns(3);
    }
 
    public static function getPluralModelLabel(): string
    {
     
        return __('Posts');
    
    }

    public static function getModelLabel(): string
    {

        return __('Post');
    
    }

    public static function getNavigationBadge(): ?string
    {

        return Post::count();       
    
    }
   
}
