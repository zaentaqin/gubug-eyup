<?php

namespace App\Filament\Widgets;

use Illuminate\Support\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use App\Models\OutboundTransaction;

class OutboundTransactionChart extends ChartWidget
{
    protected static ?string $heading = 'Outbound';
    protected static string $color = 'danger';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $startDate = !is_null($this->filters['startDate'] ?? null) ?
            Carbon::parse($this->filters['startDate']) :
            Carbon::now()->startOfYear();

        $endDate = !is_null($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            Carbon::now()->endOfYear();  // Menggunakan akhir tahun ini sebagai default

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

        // Query untuk mendapatkan jumlah total transaksi (SUM) per bulan
        $data = OutboundTransaction::select(
            DB::raw("strftime('%Y-%m', date) as month"),
            DB::raw('SUM(amount) as total_amount')  // Menggunakan SUM untuk mendapatkan total
        )
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('month')
            ->get()
            ->pluck('total_amount', 'month');

        $chartData = [];
        foreach ($months as $num => $name) {
            $yearMonth = now()->format('Y') . '-' . $num;
            $chartData[] = $data->get($yearMonth, 0);  // Nilai 0 jika tidak ada data untuk bulan tersebut
        }

        return [
            'datasets' => [
                [
                    'label' => 'Outbound Transaction',
                    'data' => $chartData, // Data untuk sumbu Y
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
