<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankResource\Pages;
use App\Filament\Resources\BankResource\RelationManagers;
use App\Models\Bank;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankResource extends Resource
{
    protected static ?string $model = Bank::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Bank Name'),
                Forms\Components\TextInput::make('account_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Account Name'),
                Forms\Components\TextInput::make('account_number')
                    ->required()
                    ->maxLength(20)
                    ->label('Account Number'),
                Forms\Components\FileUpload::make('logo')
                    ->disk('public') // Set the storage disk
                    ->directory('logos') // Set the directory
                    ->image() // Specify that the file should be an image
                    ->maxSize(2048) // Set max size to 2MB
                    ->label('Logo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Bank Name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('account_name')->label('Account Name')->searchable(),
                Tables\Columns\TextColumn::make('account_number')->label('Account Number')->searchable(),
                Tables\Columns\ImageColumn::make('logo')->label('Logo'), // Display logo as an image
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBanks::route('/'),
        ];
    }
}
