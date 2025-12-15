<?php

namespace App\Filament\Resources;
use App\Filament\Resources\ActivityLogs\Pages\ListActivityLogs;
use App\Models\ActivityLog;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ActivityLogResource extends Resource
{
    protected static ?string $model = ActivityLog::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Activity Logs';

    protected static string|\UnitEnum|null $navigationGroup = 'System';

    protected static ?int $navigationSort = 101;

    public static function canViewAny(): bool
    {
        $user = Auth::user();
        return $user instanceof User && $user->isSuperAdmin();
    }

    public static function canCreate(): bool
    {
        return false; // Tidak bisa create manual
    }

    public static function canEdit($record): bool
    {
        return false; // Tidak bisa edit
    }

    public static function canDelete($record): bool
    {
        return false; // Atau sesuaikan dengan kebijakan Anda
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('action')
                    ->disabled(),
                TextInput::make('user_name')
                    ->disabled(),
                TextInput::make('model_name')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y H:i:s')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user_name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('action')
                    ->label('Aksi')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'created' => 'Dibuat',
                        'updated' => 'Diupdate',
                        'deleted' => 'Dihapus',
                        default => $state,
                    }),
                TextColumn::make('model_label')
                    ->label('Model')
                    ->getStateUsing(fn(ActivityLog $record): string => $record->model_label)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('model_name')
                    ->label('Nama Item')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('action')
                    ->label('Aksi')
                    ->options([
                        'created' => 'Dibuat',
                        'updated' => 'Diupdate',
                        'deleted' => 'Dihapus',
                    ]),
                SelectFilter::make('model_type')
                    ->label('Model')
                    ->options(function () {
                        return ActivityLog::query()
                            ->distinct()
                            ->pluck('model_type')
                            ->mapWithKeys(function ($modelType) {
                                $basename = class_basename($modelType);
                                $label = match ($basename) {
                                    'GalleryCategory' => 'Kategori Gallery',
                                    'GalleryItem' => 'Item Gallery',
                                    'Service' => 'Layanan',
                                    'Testimonial' => 'Testimonial',
                                    'Booking' => 'Booking',
                                    'ContactMessage' => 'Pesan Kontak',
                                    'Setting' => 'Pengaturan',
                                    'User' => 'Pengguna',
                                    'Pricing' => 'Harga',
                                    default => $basename,
                                };
                                return [$modelType => $label];
                            });
                    }),
                SelectFilter::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name'),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s'); // Auto-refresh setiap 30 detik
    }

    public static function getPages(): array
    {
        return [
            'index' => ListActivityLogs::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->latest();
    }
}