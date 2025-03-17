<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CarController extends Controller
{
    public function create()
    {
        return view('cars.create-step1');
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'license_plate' => 'required|string|min:6|max:8'
        ]);

        // Clean license plate (remove spaces and dashes)
        $licensePlate = str_replace(['-', ' '], '', $validated['license_plate']);

        // Call RDW API
        $response = Http::get("https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken={$licensePlate}");

        if ($response->successful() && count($response->json()) > 0) {
            $carData = $response->json()[0];

            // Store in session for next step
            $request->session()->put('car_form_data', [
                'license_plate' => $licensePlate,
                'brand' => $carData['merk'] ?? null,
                'model' => $carData['handelsbenaming'] ?? null,
                'production_year' => $carData['datum_eerste_toelating'] ? substr($carData['datum_eerste_toelating'], 0, 4) : null,
                'seats' => $carData['aantal_zitplaatsen'] ?? null,
                'doors' => $carData['aantal_deuren'] ?? null,
                'weight' => $carData['massa_ledig_voertuig'] ?? null,
            ]);

            return redirect()->route('cars.create.step2');
        }

        return back()->withErrors(['license_plate' => 'Geen voertuig gevonden met dit kenteken.']);
    }

    public function createStep2()
    {
        // Check if step 1 is completed
        if (!session()->has('car_form_data')) {
            return redirect()->route('cars.create');
        }

        $carData = session('car_form_data');
        return view('cars.create-step2', compact('carData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'price' => 'required|numeric|min:0',
            'mileage' => 'required|integer|min:0',
            'color' => 'nullable|string|max:255',
        ]);

        // Merge with session data
        $carData = array_merge(
            session('car_form_data', []),
            $validated,
            ['user_id' => Auth::id()]
        );

        // Create the car
        Car::create($carData);

        // Clear the session
        session()->forget('car_form_data');

        return redirect()->route('home')->with('success', 'Auto succesvol toegevoegd!');
    }

    public function myCars()
    {
        $userCars = Car::where('user_id', Auth::id())->get();
        return view('cars.my-cars', compact('userCars'));
    }
}
