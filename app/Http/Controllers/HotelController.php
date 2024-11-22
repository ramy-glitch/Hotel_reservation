<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelPhoto;
use App\Models\Room;
use App\Models\Service;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        // i  want only to get the first photo of each hotel
        foreach ($hotels as $hotel) {
            
            
            $hotel->photo = HotelPhoto::where('hotel_id', $hotel->id)->first()->photo_url ?? null;
        }
        return view('customers.hotels', compact('hotels'));
    }

    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hotelname' => 'required|max:255',
            'location' => 'required|max:255',
            'child_age_limit' => 'required|integer',
            'manager_id' => 'nullable|exists:hotel_managers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('hotels.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        $hotel = Hotel::create($request->all());
        return redirect()->route('hotels.index')->with('success', 'Hotel created successfully');
    }

    public function edit($id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return redirect()->route('hotels.index')->with('error', 'Hotel not found');
        }
        return view('hotels.edit', compact('hotel'));
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return redirect()->route('hotels.index')->with('error', 'Hotel not found');
        }

        $validator = Validator::make($request->all(), [
            'hotelname' => 'sometimes|required|max:255',
            'location' => 'sometimes|required|max:255',
            'child_age_limit' => 'sometimes|required|integer',
            'manager_id' => 'nullable|exists:hotel_managers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('hotels.edit', $id)
                             ->withErrors($validator)
                             ->withInput();
        }

        $hotel->update($request->all());
        return redirect()->route('hotels.index')->with('success', 'Hotel updated successfully');
    }

    public function destroy($id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return redirect()->route('hotels.index')->with('error', 'Hotel not found');
        }

        $hotel->delete();
        return redirect()->route('hotels.index')->with('success', 'Hotel deleted successfully');
    }

    public function getHotelDetails($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('hotels.details', compact('hotel'));
    }

    public function getRooms($id)
    {
        $hotel = Hotel::findOrFail($id);
        $rooms = $hotel->rooms;
        return view('hotels.rooms', compact('rooms'));
    }

    public function getServices($id)
    {
        $hotel = Hotel::findOrFail($id);
        $services = $hotel->services;
        return view('hotels.services', compact('services'));
    }

    public function getReviews($id)
    {
        $hotel = Hotel::findOrFail($id);
        $reviews = $hotel->reviews;
        return view('hotels.reviews', compact('reviews'));
    }

    public function addPhoto(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        // Handle photo upload logic here
        return redirect()->route('hotels.show', $id)->with('success', 'Photo added successfully');
    }




    
    public function search(Request $request)
    {
        $query = Hotel::query();
    
        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }
    
        if ($request->has('services')) {
            $services = explode(',', $request->input('services'));
            foreach ($services as $service) {
                $query->whereHas('services', function ($q) use ($service) {
                    $q->where('name', 'like', '%' . trim($service) . '%');
                });
            }
        }
    
        if ($request->has('numOfPeople')) {
            $query->whereHas('rooms', function ($q) use ($request) {
                $q->where('capacity', '>=', $request->input('numOfPeople'));
            });
        }
    
        if ($request->has('maxBudget')) {
            $query->whereHas('rooms', function ($q) use ($request) {
                $q->where('price', '<=', $request->input('maxBudget'));
            });
        }
    
        if ($request->has('checkInDate')) {
            $query->whereHas('rooms', function ($q) use ($request) {
                $q->whereDoesntHave('reservations', function ($q) use ($request) {
                    $q->where('check_in', '<=', $request->input('checkInDate'))
                      ->where('check_out', '>=', $request->input('checkInDate'));
                });
            });
        }

        if ($request->has('minRating')) {
            $query->whereHas('reviews', function ($q) use ($request) {
                $q->where('rating', '>=', $request->input('minRating'));
            });
        }
    
        $hotels = $query->with(['rooms', 'services', 'reviews', 'firstPhoto'])->get();
    
        return response()->json($hotels);
    }

}