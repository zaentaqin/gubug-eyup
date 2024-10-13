<?php

namespace App\Filament\Clusters\Transactions\Resources\OutboundTransactionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Exports\OutboundTransactionExporter;
use App\Filament\Clusters\Transactions\Resources\OutboundTransactionResource;

class ListOutboundTransactions extends ListRecords
{
    protected static string $resource = OutboundTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ExportAction::make()
                ->label('Export data')
                ->exporter(OutboundTransactionExporter::class),
            Actions\CreateAction::make()
        ];
    }
}
