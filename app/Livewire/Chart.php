<?php

namespace App\Livewire;

use App\Charts\StatsLineChart;
use App\Models\Country;
use App\Models\Platform;
use App\Models\Publisher;
use App\Models\Stat;
use Livewire\Component;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class Chart extends Component
{
    public $stats;
    public $filterBy = "default";
    public $countries;
    public $selectedCountry;

    public $publishers;
    public $selectedPublisher;

    public function mount(){
        $this->countries = Country::all();
        $this->publishers = Publisher::all();
    }

    public function render()
    {
        $this->stats = Stat::count();

            $allDatesLabel = $this->generateDateRange()->toArray();
            $platform = $this->getPlatform($allDatesLabel, $this->selectedCountry);

            $chart =  (new LarapexChart)->lineChart()
            ->setXAxis($allDatesLabel)
            ->setTitle('Monthly Users')
            ->setColors(['#ffc63b', '#ff6384', '#ff6334']);

            foreach ($platform as $key => $value) {
                $chart->addLine($key, $value);
            }

            info($this->selectedCountry);
            return view('livewire.chart', [
                'chart' => $chart,
            ]);




    }

    private function generateDateRange()
    {
        $dayCollection = Stat::groupBy('day')->select('day')->get();
        $startDate = $dayCollection->min('day');
        $endDate = $dayCollection->max('day');

        return collect(\Carbon\CarbonPeriod::create($startDate, $endDate))
            ->map(function ($date) {
                return $date->format('Y-m-d');
            });
    }

    private function getPlatform(array $dates, $countryId = null){
        $platformArray = [];

        $query = Stat::query();



        if ($countryId !== null) {
            $query->where('country_id', $countryId);
        }

        $platformIds = $query->pluck('platform_id')->unique()->toArray();

        foreach ($platformIds as $id) {
            $platformName = Platform::find($id)->name;

            $ratesPerDay = [];

            foreach ($dates as $date) {
                $rate = Stat::where('platform_id', $id)
                    ->when($countryId !== null, function ($query) use ($countryId) {
                        $query->where('country_id', $countryId);
                    })
                    ->where('day', $date)
                    ->selectRaw('ROUND(AVG(conversions/impressions), 2) as rate')
                    ->pluck('rate')
                    ->first();

                $ratesPerDay[] = $rate ?? 0;
            }

            $platformArray[$platformName] = $ratesPerDay;
        }
        // dd($platformArray);
        return $platformArray;
    }

    public function loadData()
    {
        $this->render();
    }

}
