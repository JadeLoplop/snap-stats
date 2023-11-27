<?php

namespace App\Exports;

use App\Models\Publisher;
use App\Models\Stat;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StatsDayExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {

        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $stats = Stat::whereBetween('day', [$startDate, $endDate])
        ->groupBy('day')
        ->selectRaw('day, SUM(impressions) as impressions, SUM(conversions) as conversions, ROUND(SUM(conversions)/SUM(impressions), 2) as rate')
        ->orderBy('day', 'DESC')
        ->get();

        return $stats;
    }

    public function headings(): array
    {
        return [
            'Day',
            'Impressions',
            'Conversions',
            'Conversion Rate'
        ];
    }
}
