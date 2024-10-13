<?php

namespace App\Filament\Clusters\Transactions\Resources\InboundTransactionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Exports\InboundTransactionExporter;
use App\Filament\Clusters\Transactions\Resources\InboundTransactionResource;

class ListInboundTransactions extends ListRecords
{
    protected static string $resource = InboundTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ExportAction::make()
                ->label('Export data')
                ->exporter(InboundTransactionExporter::class),
            Actions\CreateAction::make(),
        ];
    }
}
