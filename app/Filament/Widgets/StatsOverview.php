<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\InboundTransaction;
use App\Models\OutboundTransaction;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        $startDate = !is_null($this->filters['startDate'] ?? null) ?
            Carbon::parse($this->filters['startDate']) :
            Carbon::now()->startOfYear();

        $endDate = !is_null($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            Carbon::now()->endOfYear();

        $inbound = InboundTransaction::whereBetween('date', [$startDate, $endDate])->sum('amount');
        $outbound = OutboundTransaction::whereBetween('date', [$startDate, $endDate])->sum('amount');
        $orders = Order::whereBetween('date', [$startDate, $endDate])->count();

        $balance = $inbound - $outbound;


        $formatRupiah = function ($amount) {
            return 'Rp ' . number_format($amount, 0, ',', '.');
        };

        return [
            Stat::make('Balance', $formatRupiah($balance)),
            Stat::make('Inbound', $formatRupiah($inbound)),
            Stat::make('Outbound', $formatRupiah($outbound)),
            Stat::make('Orders', $orders),
        ];
    }
}
