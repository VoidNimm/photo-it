<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryItemResource\Pages;
use App\Models\GalleryItem;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class GalleryItemResource extends Resource
{
    protected static ?string $model = GalleryItem::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Gallery Items';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'category_name')
                    ->searchable()
                    ->preload()
                    ->label('Kategori (opsional)'),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Foto'),
                FileUpload::make('image_path')
                    ->image()
                    ->disk('public')
                    ->directory('gallery')
                    ->required()
                    ->imageEditor()
                    ->columnSpanFull()
                    ->label('Gambar'),
                TextInput::make('display_order')
                    ->numeric()
                    ->default(0)
                    ->label('Urutan Tampil'),
                Toggle::make('is_featured')
                    ->default(false)
                    ->label('Tampil di Homepage'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->disk('public')
                    ->size(50),
                TextColumn::make('category.category_name')
                    ->searchable()
                    ->label('Kategori'),
                TextColumn::make('title')
                    ->searchable()
                    ->label('Judul'),
                IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),
                TextColumn::make('display_order')
                    ->sortable()
                    ->label('Urutan'),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->relationship('category', 'category_name')
                    ->label('Kategori'),
                TernaryFilter::make('is_featured')
                    ->label('Featured'),
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
            ->defaultSort('display_order', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleryItems::route('/'),
            'create' => Pages\CreateGalleryItem::route('/create'),
            'edit' => Pages\EditGalleryItem::route('/{record}/edit'),
        ];
    }
}
