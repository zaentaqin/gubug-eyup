<?php

namespace App\Filament\Clusters\Transactions\Resources\OutboundTransactionResource\Pages;

use App\Filament\Clusters\Transactions\Resources\OutboundTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOutboundTransaction extends EditRecord
{
    protected static string $resource = OutboundTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
