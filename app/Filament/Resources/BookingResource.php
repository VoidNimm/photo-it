<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationLabel = 'Bookings';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('booking_number')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(50)
                    ->label('Nomor Booking'),
                TextInput::make('client_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Klien'),
                TextInput::make('client_email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label('Email Klien'),
                TextInput::make('client_phone')
                    ->tel()
                    ->required()
                    ->maxLength(50)
                    ->label('Telepon Klien'),
                Select::make('service_id')
                    ->relationship('service', 'service_name')
                    ->searchable()
                    ->preload()
                    ->label('Layanan'),
                DatePicker::make('event_date')
                    ->label('Tanggal Acara'),
                TextInput::make('location')
                    ->maxLength(255)
                    ->label('Lokasi Acara'),
                Textarea::make('notes')
                    ->rows(3)
                    ->columnSpanFull()
                    ->label('Catatan'),
                Select::make('booking_status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->label('Status Booking'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking_number')
                    ->searchable()
                    ->sortable()
                    ->label('No. Booking'),
                TextColumn::make('client_name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Klien'),
                TextColumn::make('client_email')
                    ->searchable()
                    ->label('Email'),
                TextColumn::make('service.service_name')
                    ->searchable()
                    ->label('Layanan'),
                TextColumn::make('event_date')
                    ->date()
                    ->sortable()
                    ->label('Tanggal Acara'),
                TextColumn::make('booking_status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'completed' => 'success',
                        'confirmed' => 'info',
                        'pending' => 'warning',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->label('Status'),
            ])
            ->filters([
                SelectFilter::make('booking_status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->label('Status'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
