<?php

namespace App\Livewire;

use App\Exports\StatsExport;
use App\Models\Publisher;
use App\Models\Stat;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class OverallPublisherReport extends Component
{
    use WithPagination;

    public $conversionRate;

    private $model;
    private $publisher;

    public $sortDirection = 'DESC';
    public $sortColumnName = 'impressions';

    public function render()
    {
        $this->model = new Stat;
        $this->publisher = new Publisher;

        $stats = $this->model->groupBy('publisher_id')
        ->selectRaw('publisher_id, SUM(impressions) as impressions, SUM(conversions) as conversions, ROUND(SUM(conversions)/SUM(impressions), 2) as rate')
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate(10);

        return view('livewire.overall-publisher-report',[
            'stats' => $stats
        ]);
    }

    public function sortBy(string $columnName){

        if($this->sortColumnName === $columnName){
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'ASC';
        }

        $this->sortColumnName = $columnName;

    }

    public function swapSortDirection(){
        return $this->sortDirection === 'ASC' ? 'DESC' : 'ASC';
    }

    public function publisherName(int $id){
        return $this->publisher->find($id)->name;
    }

    public function export(){
        return Excel::download(new StatsExport, 'overall_publisher_report.xlsx');
    }

}
