<?php

namespace App\Filament\Clusters\Transactions\Resources\InboundTransactionResource\Pages;

use App\Filament\Clusters\Transactions\Resources\InboundTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInboundTransaction extends CreateRecord
{
    protected static string $resource = InboundTransactionResource::class;
}
