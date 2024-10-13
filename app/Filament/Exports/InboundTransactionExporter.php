<?php

namespace App\Filament\Exports;

use App\Models\InboundTransaction;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class InboundTransactionExporter extends Exporter
{
    protected static ?string $model = InboundTransaction::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('date'),
            ExportColumn::make('order.name')->label('Order'),
            ExportColumn::make('amount'),
            ExportColumn::make('status'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your inbound transaction export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
