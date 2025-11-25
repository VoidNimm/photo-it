<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->disabled()
                    ->label('Nama'),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->disabled()
                    ->label('Email'),
                TextInput::make('subject')
                    ->required()
                    ->disabled()
                    ->label('Subjek'),
                Textarea::make('message')
                    ->required()
                    ->disabled()
                    ->rows(6)
                    ->columnSpanFull()
                    ->label('Pesan'),
                TextInput::make('phone')
                    ->tel()
                    ->disabled()
                    ->label('Telepon')
                    ->placeholder('-'),
                Toggle::make('is_read')
                    ->label('Sudah Dibaca'),
            ]);
    }
}
