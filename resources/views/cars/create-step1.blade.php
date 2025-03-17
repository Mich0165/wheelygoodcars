@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Auto toevoegen - Stap 1</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('cars.store.step1') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="license_plate" class="form-label">Kenteken</label>
                            <input type="text"
                                   class="form-control @error('license_plate') is-invalid @enderror"
                                   id="license_plate"
                                   name="license_plate"
                                   value="{{ old('license_plate') }}"
                                   placeholder="AB-12-CD">
                            @error('license_plate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Volgende stap</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
