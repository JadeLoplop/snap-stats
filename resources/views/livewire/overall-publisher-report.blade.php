<div class="card-body px-0 pb-2">
    <span class="d-flex align-items-center gap-3">
        <h5 class="ms-4 text-muted">Overall Publisher Report</h5>
        <button type="button" class="btn bg-gradient-primary" wire:click="export">
            <i style="cursor: pointer" class="fa fa-download" aria-hidden="true"></i>
        </button>
    </span>
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th wire:click="sortBy('publisher_id')" style="cursor: pointer" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Publisher
                        <span>
                            <i class="fa fa-arrow-up {{$sortColumnName === 'publisher_id' && $sortDirection === 'ASC' ? 'text-primary' : ''}}"></i>
                            <i class="fa fa-arrow-down {{$sortColumnName === 'publisher_id' && $sortDirection === 'DESC' ? 'text-primary' : ''}}" aria-hidden="true"></i>
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
                            {{ $this->publisherName($stat->publisher_id) }}
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
