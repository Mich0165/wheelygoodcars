@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Mijn Aanbod</h1>
    @if($userCars->isEmpty())
        <p>Je hebt nog geen auto's toegevoegd.</p>
    @else
        <div class="row">
            @foreach($userCars as $car)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                            <p class="card-text">Prijs: €{{ $car->price }}</p>
                            <p class="card-text">Kilometerstand: {{ $car->mileage }} km</p>
                            <a href="#" class="btn btn-primary">Bekijk details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
