<?php

namespace App\Filament\Widgets;

use App\Models\InboundTransaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class InboundTransactionChart extends ChartWidget
{
    protected static ?string $heading = 'Inbound';
    protected static string $color = 'success';
    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $startDate = !is_null($this->filters['startDate'] ?? null) ?
            Carbon::parse($this->filters['startDate']) :
            Carbon::now()->startOfYear();

        $endDate = !is_null($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            Carbon::now()->endOfYear();

        $months = [
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ];

        $data = InboundTransaction::select(
            DB::raw("strftime('%Y-%m', date) as month"),
            DB::raw('SUM(amount) as total_amount')
        )
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('month')
            ->get()
            ->pluck('total_amount', 'month');

        $chartData = [];
        foreach ($months as $num => $name) {
            $yearMonth = now()->format('Y') . '-' . $num;
            $chartData[] = $data->get($yearMonth, 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Inbound Transaction',
                    'data' => $chartData,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
