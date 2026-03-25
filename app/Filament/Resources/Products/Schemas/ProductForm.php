<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->prefix('$'),
                Textarea::make('description')
                    ->rows(5)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->directory('products'),
                FileUpload::make('images')
                    ->multiple()
                    ->image()
                    ->directory('products'),
            ]);
    }
}
