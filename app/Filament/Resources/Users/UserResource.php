<?php

namespace App\Filament\Resources\Users;

use App\Enums\UserRole;
use App\Filament\Resources\Users\Pages;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Users';

    protected static string|\UnitEnum|null $navigationGroup = 'System';

    protected static ?int $navigationSort = 100;

    // Hanya super admin yang bisa akses
    public static function canViewAny(): bool
    {
        $user = Auth::user();
        return $user instanceof User && $user->canManageUsers();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama'),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->label('Email'),

                Select::make('role')
                    ->options([
                        UserRole::SuperAdmin->value => UserRole::SuperAdmin->label(),
                        UserRole::Admin->value => UserRole::Admin->label(),
                        UserRole::User->value => UserRole::User->label(),
                    ])
                    ->required()
                    ->default(UserRole::User->value)
                    ->label('Role')
                    ->disabled(fn($record) => $record && $record->isSuperAdmin() && Auth::id() !== $record->id),

                TextInput::make('password')
                    ->password()
                    ->label('Password Baru')
                    ->helperText('Kosongkan jika tidak ingin mengubah password')
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn($livewire) => $livewire instanceof Pages\CreateUser)
                    ->rules([
                        'sometimes',
                        Password::min(8),
                    ])
                    ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                    ->visible(fn($livewire) => $livewire instanceof Pages\CreateUser || $livewire instanceof Pages\EditUser),

                TextInput::make('password_confirmation')
                    ->password()
                    ->label('Konfirmasi Password')
                    ->same('password')
                    ->required(fn($livewire, $get) => filled($get('password')))
                    ->visible(fn($livewire) => $livewire instanceof Pages\CreateUser || $livewire instanceof Pages\EditUser),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama'),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label('Email'),

                TextColumn::make('role')
                    ->badge()
                    ->color(fn(UserRole $state): string => match ($state) {
                        UserRole::SuperAdmin => 'danger',
                        UserRole::Admin => 'warning',
                        UserRole::User => 'success',
                    })
                    ->formatStateUsing(fn(UserRole $state): string => $state->label())
                    ->sortable()
                    ->label('Role'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Dibuat'),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Diupdate'),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->options([
                        UserRole::SuperAdmin->value => UserRole::SuperAdmin->label(),
                        UserRole::Admin->value => UserRole::Admin->label(),
                        UserRole::User->value => UserRole::User->label(),
                    ])
                    ->label('Role'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->disabled(fn($record) => $record && $record->isSuperAdmin() && Auth::id() !== $record->id),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->disabled(fn($records) => $records->contains(fn($record) => $record->isSuperAdmin())),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}