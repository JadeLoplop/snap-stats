<?php

namespace App\Exports;

use App\Models\Publisher;
use App\Models\Stat;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StatsExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    protected $publishers;

    public function __construct()
    {
        $publisherArray = Publisher::all();
        $this->publishers = $publisherArray->pluck('name', 'id')->toArray();
    }


    public function collection()
    {
        $stats = Stat::groupBy('publisher_id')
        ->selectRaw('publisher_id, SUM(impressions) as impressions, SUM(conversions) as conversions, ROUND(SUM(conversions)/SUM(impressions), 2) as rate')
        ->orderBy('impressions', 'DESC')
        ->get();

        return $stats;
    }

    public function headings(): array
    {
        return [
            'Publisher',
            'Impressions',
            'Conversions',
            'Conversion Rate'
        ];
    }

    public function map($row): array
    {
        $publisher = $this->publishers[$row['publisher_id']] ?? null;

        return [
            $publisher,
            $row->impressions,
            $row->conversions,
            $row->rate,
        ];
    }
}
