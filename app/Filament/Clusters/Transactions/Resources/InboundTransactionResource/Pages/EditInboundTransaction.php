<?php

namespace App\Filament\Clusters\Transactions\Resources\InboundTransactionResource\Pages;

use App\Filament\Clusters\Transactions\Resources\InboundTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInboundTransaction extends EditRecord
{
    protected static string $resource = InboundTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
