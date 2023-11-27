<?php

namespace App\Imports;

use App\Models\Country;
use App\Models\Platform;
use App\Models\Publisher;
use App\Models\Stat;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StatsImport implements ToModel, WithHeadingRow, WithValidation, WithMapping
{
    use Importable;

    protected $countries;
    protected $platforms;
    protected $publishers;

    public function __construct()
    {
        $countryArray = Country::all();
        $this->countries = $countryArray->pluck('id', 'iso')->toArray();

        $platformArray = Platform::all();
        $this->platforms = $platformArray->pluck('id', 'name')->toArray();

        $publisherArray = Publisher::all();
        $this->publishers = $publisherArray->pluck('id', 'name')->toArray();
    }

    public function map($row): array
    {
        if (gettype($row['day'] == 'double')) {
            $row['day'] = Date::excelToDateTimeObject($row['day'])->format('Y-m-d');
        }

        return $row;
    }

    public function model(array $row)
    {
        $countryId = $this->countries[$row['iso']] ?? null;
        $platformId = $this->platforms[$row['platform']] ?? null;
        $publisherId = $this->publishers[$row['publisher']] ?? null;
        // dd($countryId, $this->countries, $row['iso']);
        return new Stat([
            'day' => $row['day'],
            'country_id' => $countryId,
            'platform_id' => $platformId,
            'publisher_id' => $publisherId,
            'impressions' => $row['impressions'],
            'conversions' => $row['conversions'],
        ]);
    }

    public function rules(): array
    {
        return [
            'day' => 'required',
            'iso' => 'required|string|exists:countries,iso',
            'platform' => 'required|string|exists:platforms,name',
            'publisher' => 'required|string|exists:publishers,name',
            'impressions' => 'nullable|numeric',
            'conversions' => 'nullable|numeric',
        ];
    }


}
