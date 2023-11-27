@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <livewire:chart />
    <livewire:datatable />
</div>
@endsection
