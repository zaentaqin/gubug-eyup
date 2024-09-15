<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\OrderResource;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('date', 'desc')
            ->columns([
                TextColumn::make('date')
                    ->label('Date')
                    ->dateTime('d-m-Y'),

                TextColumn::make('name')
                    ->sortable(),

                TextColumn::make('marital_address')
                    ->sortable(),

                TextColumn::make('grand_total')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('discount')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('invoice.status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'DP' => 'primary',
                        'Lunas' => 'success',
                        default => 'default',
                    })
                    ->sortable(),
            ]);
    }
}
