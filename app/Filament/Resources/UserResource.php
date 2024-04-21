<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Forms;
use Filament\Forms\Components\DatePicke;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Tables\Columns\TextInputColumn;
use Illuminate\Support\HtmlString;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Section::make()->schema([
                TextInput::make('name')
                ->translateLabel()
                ->autofocus()
                ->hintIcon('heroicon-m-user')
                ->placeholder(__('Enter Name'))
                ->required(),
               
                TextInput::make('email')
                ->translateLabel()
                ->email()
                
                ->required()
                ->placeholder(__('Enter Email'))
                ->hintIcon('heroicon-m-envelope')
                ->unique(),
                
                TextInput::make('password')
                ->translateLabel()
                ->placeholder(__('Enter password'))
                ->password()
                ->required()
                ->revealable()
                ->hiddenOn(['edit','view']),

                Select::make('roles')
                ->translateLabel()
                ->relationship('roles','name')
                // ->getSearchResultsUsing(fn (string $search): array => Role::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())
                ->getOptionLabelUsing(fn ($value): ?string => Str::headline($value))
                ->searchable(['name'])
                ->preload()
                ->required(),
           
               ]),
              
        ]);
    }
                
    public static function table(Table $table): Table
    {
        return $table

            ->columns([
 
               
              TextColumn::make('id')
              ->label('#'),

              TextColumn::make('name')
              ->translateLabel(),

              TextInputColumn::make('email')
              ->rules(['required', 'max:255']),

              TextColumn::make('roles.name')
              ->translateLabel()
              ->formatStateUsing(fn ($state): string => Str::headline($state))
              ->badge()
              ->color(fn (string $state): string => match ($state) {
                'panel_user' => 'warning',
                'super_admin' => 'success',
            }),

             TextColumn::make('created_at')
             ->label(__('Date'))
             ->date(),
             
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                 Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
                
        ]),

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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' =>  Pages\ViewUser::route('/{record}'),
            'setings' =>  Pages\Settings::route('setings'),

        ];
    }
    public static function getPluralModelLabel(): string
    {
        return __('Users');
    }

    public static function getModelLabel(): string
    {
        return __('User');
    }

    public static function getNavigationGroup(): ?string
    {
        return Utils::isResourceNavigationGroupEnabled()
            ? __('filament-shield::filament-shield.nav.group')
            : '';
    }

    public static function getNavigationBadge(): ?string
    {
        return User::count();
           
    }
     
}
