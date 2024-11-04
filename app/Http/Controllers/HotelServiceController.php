<?php

namespace App\Http\Controllers;

use App\Models\HotelService;
use Illuminate\Http\Request;

class HotelServiceController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $hotelServices = HotelService::all();
        return view('hotel_services.index', compact('hotelServices'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $hotelService = HotelService::create($validatedData);
        return redirect()->route('hotel_services.index')->with('success', 'Hotel Service created successfully');
    }

    // Display the specified resource.
    public function show($id)
    {
        $hotelService = HotelService::findOrFail($id);
        return view('hotel_services.show', compact('hotelService'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $hotelService = HotelService::findOrFail($id);
        $hotelService->update($validatedData);
        return redirect()->route('hotel_services.index')->with('success', 'Hotel Service updated successfully');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $hotelService = HotelService::findOrFail($id);
        $hotelService->delete();
        return redirect()->route('hotel_services.index')->with('success', 'Hotel Service deleted successfully');
    }
}