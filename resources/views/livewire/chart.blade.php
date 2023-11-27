<div class="row mt-4">
    @if ($stats)
    <div class="col-lg-12">
        <div class="card z-index-2">
            <div class="card-header pb-0">

                <h6>Platform Performance</h6>
                <p class="text-sm">
                    <span class="font-weight-bold">By day</span>
                </p>
            </div>
            <div class="ms-4 gap-3">
              <!-- Button trigger modal -->
                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#filterCountryModal">
                    Country Filter
                </button>
            </div>
            <div class="card-body p-3">

                {!! $chart->container() !!}
            </div>
        </div>
    </div>
    @endif

      <!-- Modal -->
      <div class="modal fade" id="filterCountryModal" tabindex="-1" role="dialog" aria-labelledby="filterCountryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="filterCountryModalLabel">Country Filter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <select wire:model="selectedCountry" class="form-select ">
                    <option value="">Select Country</option>
                    @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" wire:click="loadData" class="btn bg-gradient-primary" data-bs-dismiss="modal">Load</button>
            </div>
        </div>
        </div>
    </div>
</div>


@section('scripts')

@if ($stats)
<script>
    function handleCategoryChange(value) {
        console.log(value);
    }
</script>
<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}
@endif
@endsection
