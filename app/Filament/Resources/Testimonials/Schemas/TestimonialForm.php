<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('client_name')
                    ->required(),
                TextInput::make('client_title')
                    ->default(null),
                FileUpload::make('client_image')
                    ->disk('public') 
                    ->directory('testimonials')
                    ->image(),
                TextInput::make('rating')
                    ->numeric()
                    ->default(5),
                Textarea::make('review_text')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_featured'),
                Toggle::make('is_approved'),
            ]);
    }
}
