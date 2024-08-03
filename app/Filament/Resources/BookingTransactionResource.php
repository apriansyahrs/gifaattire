<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingTransactionResource\Pages;
use App\Filament\Resources\BookingTransactionResource\RelationManagers;
use App\Models\BookingTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingTransactionResource extends Resource
{
    protected static ?string $model = BookingTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-percent';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Name'),
                Forms\Components\TextInput::make('phone_number')
                    ->required()
                    ->maxLength(15)
                    ->label('Phone Number'),
                Forms\Components\Textarea::make('address')
                    ->required()
                    ->maxLength(65535)
                    ->label('Address'),
                Forms\Components\Select::make('attire_id')
                    ->relationship('attire', 'name')
                    ->required()
                    ->label('Attire'),
                Forms\Components\DateTimePicker::make('booked_at')
                    ->required()
                    ->label('Booking Date & Time'),
                Forms\Components\Textarea::make('note')
                    ->maxLength(65535)
                    ->label('Note'),
                Forms\Components\TextInput::make('total_amount')
                    ->required()
                    ->numeric()
                    ->label('Total Amount')
                    ->prefix('$'),
                Forms\Components\Toggle::make('is_paid')
                    ->label('Is Paid'),
                Forms\Components\FileUpload::make('proof')
                    ->disk('public')
                    ->directory('proofs')
                    ->label('Proof of Payment'),
                Forms\Components\TextInput::make('booking_trx_id')
                    ->required()
                    ->unique(BookingTransaction::class, 'booking_trx_id', ignoreRecord: true)
                    ->maxLength(255)
                    ->label('Transaction ID'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone_number')->label('Phone Number')->searchable(),
                Tables\Columns\TextColumn::make('attire.name')->label('Attire')->sortable(),
                Tables\Columns\TextColumn::make('booked_at')->label('Booked At')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('total_amount')->label('Total Amount')->sortable()->prefix('$'),
                Tables\Columns\BooleanColumn::make('is_paid')->label('Paid'),
                Tables\Columns\ImageColumn::make('proof')->label('Proof'),
                Tables\Columns\TextColumn::make('booking_trx_id')->label('Transaction ID')->searchable(),
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
            'index' => Pages\ListBookingTransactions::route('/'),
            'create' => Pages\CreateBookingTransaction::route('/create'),
            'edit' => Pages\EditBookingTransaction::route('/{record}/edit'),
        ];
    }
}
