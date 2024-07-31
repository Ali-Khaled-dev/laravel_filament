<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form->schema(User::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                TextColumn::make('id')
                    ->label('#'),

                TextColumn::make('name')
                    ->translateLabel(),

                TextColumn::make('email')
                    ->label(__('Email')),

                TextColumn::make('roles.name')
                ->label(__('Roles'))
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
