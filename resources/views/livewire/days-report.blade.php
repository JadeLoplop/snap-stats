<div class="card-body px-0 pb-2">
    <span class="d-flex align-items-center gap-3">
        <h5 class="ms-4 text-muted">30 days Report</h5>

        <button type="button" class="btn bg-gradient-primary" wire:click="export">
            <i style="cursor: pointer" class="fa fa-download" aria-hidden="true"></i>
        </button>
    </span>
    <!-- Button trigger modal -->
    <button type="button" class="btn bg-light ms-3" data-bs-toggle="modal" data-bs-target="#filterDatePeriod">
        Date Filter
    </button>

    <button type="button" wire:click="resetFilter" class="btn bg-secondary text-white ms-3">
        Reset Filter
    </button>

    <!-- Modal -->
    <div class="modal fade" id="filterDatePeriod" tabindex="-1" role="dialog" aria-labelledby="filterDatePeriodLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="filterDatePeriodLabel">Date Filter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center  flex-row gap-3">
                    <div>
                        <label for="">Date From</label>
                        <input type="date" wire:model="dateFrom" class="form-control form-contrl-sm" id="dateFrom">
                    </div>
                    <div>
                        <label for="">Date To</label>
                        <input type="date" wire:model="dateTo" class="form-control form-contrl-sm" id="dateTo">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" wire:click="loadData" class="btn bg-gradient-primary" data-bs-dismiss="modal">Load</button>
            </div>
        </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th wire:click="sortBy('day')" style="cursor: pointer" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Day
                        <span>
                            <i class="fa fa-arrow-up {{$sortColumnName === 'day' && $sortDirection === 'ASC' ? 'text-primary' : ''}}"></i>
                            <i class="fa fa-arrow-down {{$sortColumnName === 'day' && $sortDirection === 'DESC' ? 'text-primary' : ''}}" aria-hidden="true"></i>
                        </span>
                    </th>
                    <th wire:click="sortBy('impressions')" style="cursor: pointer" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Impression
                        <span>
                            <i class="fa fa-arrow-up {{$sortColumnName === 'impressions' && $sortDirection === 'ASC' ? 'text-primary' : ''}}"></i>
                            <i class="fa fa-arrow-down {{$sortColumnName === 'impressions' && $sortDirection === 'DESC' ? 'text-primary' : ''}}" aria-hidden="true"></i>
                        </span>
                    </th>
                    <th wire:click="sortBy('conversions')" style="cursor: pointer" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Conversion
                        <span>
                            <i class="fa fa-arrow-up {{$sortColumnName === 'conversions' && $sortDirection === 'ASC' ? 'text-primary' : ''}}"></i>
                            <i class="fa fa-arrow-down {{$sortColumnName === 'conversions' && $sortDirection === 'DESC' ? 'text-primary' : ''}}" aria-hidden="true"></i>
                        </span>
                    </th>
                    <th wire:click="sortBy('rate')" style="cursor: pointer" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Conversion Rate
                        <span>
                            <i class="fa fa-arrow-up {{$sortColumnName === 'rate' && $sortDirection === 'ASC' ? 'text-primary' : ''}}"></i>
                            <i class="fa fa-arrow-down {{$sortColumnName === 'rate' && $sortDirection === 'DESC' ? 'text-primary' : ''}}" aria-hidden="true"></i>
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stats as $stat)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1 text-uppercase ">
                            {{ $stat->day->format('d/m/Y') }}
                        </div>
                    </td>
                    <td class="align-middle text-center text-sm">{{ $stat->impressions }}</td>
                    <td class="align-middle text-center text-sm">{{ $stat->conversions }}</td>
                    <td class="align-middle text-center text-sm">{{ $stat->rate }}</td>
                </tr>
                @endforeach


            </tbody>

        </table>
        <div class="d-flex align-content-center flex-row-reverse ">
            {{ $stats->links() }}
        </div>
    </div>
</div>
