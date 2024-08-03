<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttireResource\Pages;
use App\Filament\Resources\AttireResource\RelationManagers;
use App\Models\Attire;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttireResource extends Resource
{
    protected static ?string $model = Attire::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Attire Name'),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(Attire::class, 'slug', ignoreRecord: true)
                    ->maxLength(255)
                    ->label('Slug'),
                Forms\Components\FileUpload::make('thumbnail')
                    ->disk('public')
                    ->directory('thumbnails')
                    ->image()
                    ->maxSize(2048)
                    ->label('Thumbnail'),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->label('Description'),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->label('Category'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug')->label('Slug')->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')->label('Thumbnail'),
                Tables\Columns\TextColumn::make('category.name')->label('Category'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListAttires::route('/'),
            'create' => Pages\CreateAttire::route('/create'),
            'edit' => Pages\EditAttire::route('/{record}/edit'),
        ];
    }
}
