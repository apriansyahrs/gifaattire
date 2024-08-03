<?php

namespace App\Filament\Resources\AttireResource\Pages;

use App\Filament\Resources\AttireResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttires extends ListRecords
{
    protected static string $resource = AttireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
