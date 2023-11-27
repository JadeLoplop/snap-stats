<?php

namespace App\Livewire;

use App\Exports\StatsDayExport;
use App\Models\Publisher;
use App\Models\Stat;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class DaysReport extends Component
{
    use WithPagination;

    public $conversionRate;

    private $model;
    private $publisher;

    public $sortDirection = 'DESC';
    public $sortColumnName = 'day';

    public $dateFrom = '';
    public $dateTo = '';

    private $stats;

    public function render()
    {
        $this->stats = new Stat;

        if ($this->dateFrom == '' || $this->dateTo == '') {
            $startDate = Carbon::now()->subDays(30)->toDateString();
            $endDate = Carbon::now()->toDateString();

            $this->stats = $this->stats->whereBetween('day', [$startDate, $endDate]);
        } else {
            $this->stats = $this->stats->whereBetween('day', [$this->dateFrom, $this->dateTo]);
        }


        $this->stats = $this->stats->groupBy('day')
            ->selectRaw('day, SUM(impressions) as impressions, SUM(conversions) as conversions, ROUND(SUM(conversions)/SUM(impressions), 2) as rate')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(10);

        return view('livewire.days-report', [
            'stats' => $this->stats
        ]);
    }

    public function sortBy(string $columnName)
    {

        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'ASC';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'ASC' ? 'DESC' : 'ASC';
    }

    public function publisherName(int $id)
    {
        return $this->publisher->find($id)->name;
    }

    public function loadData()
    {
        $this->render();
    }

    public function resetFilter()
    {
        $this->dateFrom = '';
        $this->dateTo = '';
    }

    public function export()
    {
        return Excel::download(new StatsDayExport, '30_days_report.xlsx');
    }
}
