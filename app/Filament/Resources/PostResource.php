<?php

namespace App\Filament\Resources;


use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers\AuthorsRelationManager;
use App\Filament\Resources\PostResource\RelationManagers\CommentRelationManager;
use App\Models\Post;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TagsInput;
use Filament\Support\Enums\IconPosition;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Testing\Constraints\SoftDeletedInDatabase;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Filament\Resources\SoftDeleted;
use Filament\Actions\CreateAction;
use Filament\Infolists\Components\ImageEntry;
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

                SpatieMediaLibraryImageColumn::make('avatar')
                ->label(__('Image'))
                ->conversion('thumb')
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

        ])->columns(1);
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
