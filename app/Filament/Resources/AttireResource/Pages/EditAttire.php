<?php

namespace App\Filament\Resources\AttireResource\Pages;

use App\Filament\Resources\AttireResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttire extends EditRecord
{
    protected static string $resource = AttireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
