<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Illuminate\Support\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class OrderChart extends ChartWidget
{
    protected static ?string $heading = 'Order';
    protected static string $color = 'info';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $startDate = !is_null($this->filters['startDate'] ?? null) ?
            Carbon::parse($this->filters['startDate']) :
            Carbon::now()->startOfYear();

        $endDate = !is_null($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            now();

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

        $data = Order::select(
            DB::raw("strftime('%Y-%m', date) as month"),
            DB::raw('COUNT(*) as count')
        )
            ->whereBetween('date', [now()->startOfYear(), now()->endOfYear()])
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month');

        $chartData = [];
        foreach ($months as $num => $name) {
            $yearMonth = now()->format('Y') . '-' . $num;
            $chartData[] = $data->get($yearMonth, 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $chartData, // Data untuk sumbu Y
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
