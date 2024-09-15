<?php

namespace App\Filament\Clusters\Transactions\Resources\OutboundTransactionResource\Pages;

use App\Filament\Clusters\Transactions\Resources\OutboundTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOutboundTransaction extends CreateRecord
{
    protected static string $resource = OutboundTransactionResource::class;
}
