@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Auto toevoegen - Stap 2</div>

                <div class="card-body">
                    <div class="mb-4">
                        <h5>Voertuig gegevens:</h5>
                        <p><strong>Kenteken:</strong> {{ $carData['license_plate'] }}</p>
                        <p><strong>Merk:</strong> {{ $carData['brand'] }}</p>
                        <p><strong>Model:</strong> {{ $carData['model'] }}</p>
                        <p><strong>Bouwjaar:</strong> {{ $carData['production_year'] }}</p>
                        <p><strong>Aantal zitplaatsen:</strong> {{ $carData['seats'] }}</p>
                        <p><strong>Aantal deuren:</strong> {{ $carData['doors'] }}</p>
                        <p><strong>Gewicht:</strong> {{ $carData['weight'] }} kg</p>
                    </div>

                    <form method="POST" action="{{ route('cars.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="price" class="form-label">Prijs (€)</label>
                            <input type="number"
                                   class="form-control @error('price') is-invalid @enderror"
                                   id="price"
                                   name="price"
                                   value="{{ old('price') }}"
                                   step="0.01">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mileage" class="form-label">Kilometerstand</label>
                            <input type="number"
                                   class="form-control @error('mileage') is-invalid @enderror"
                                   id="mileage"
                                   name="mileage"
                                   value="{{ old('mileage') }}">
                            @error('mileage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="color" class="form-label">Kleur</label>
                            <input type="text"
                                   class="form-control @error('color') is-invalid @enderror"
                                   id="color"
                                   name="color"
                                   value="{{ old('color') }}">
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Auto toevoegen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
