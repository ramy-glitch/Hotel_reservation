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

    

    
    /** ************************************************* */
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




    /*************************************  main code  ************************************** */


    

    public function index()
    {
        $hotels = Hotel::with(['firstPhoto', 'reviews'])->get();
    
        // Extract photo_url and calculate rating for each hotel
        foreach ($hotels as $hotel) {
            if (isset($hotel->firstPhoto)) {
                $hotel->photo_url = $hotel->firstPhoto->photo_url;
            }
    
            // Calculate the average rating from reviews
            $hotel->rating = $hotel->reviews->avg('rating') ?? 'No rating available';
        }
    
        return view('customers.hotels', compact('hotels'));
    }
    



    public function search(Request $request)
    {

        $request->validate([
            'rating' => 'nullable|integer|min:1|max:5',
            'hotelname' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'services' => 'nullable|string|max:255',
            'numOfPeople' => 'nullable|integer|min:1',
            'maxBudget' => 'nullable|numeric|min:0',
            'checkInDate' => 'nullable|date|after_or_equal:today',
        ]);

        $query = Hotel::query();
    
        // Apply filters based on the request
        if ($request->filled('rating')) {
            $query->whereHas('reviews', function ($q) use ($request) {
                $q->where('rating', '=', $request->input('rating'));
            });
        }
    
        if ($request->filled('hotelname')) {
            $query->where('hotelname', 'like', '%' . $request->input('hotelname') . '%');
        }
    
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }
    
        if ($request->filled('services')) {
            $query->whereHas('services', function ($q) use ($request) {
                $q->where('servicename', 'like', '%' . $request->input('services') . '%');
            });
        }
    
        if ($request->filled('numOfPeople')) {
            $numOfPeople = $request->input('numOfPeople');
            $query->whereHas('rooms', function ($q) use ($numOfPeople) {
                $q->whereDoesntHave('reservations', function ($q) {
                    $q->where('check_in_date', '<=', now())
                      ->where('check_out_date', '>=', now());
                })->where('max_capacity', '>=', 1); // Ensure room has at least 1 capacity
            })->with(['rooms' => function ($q) use ($numOfPeople) {
                $q->whereDoesntHave('reservations', function ($q) {
                    $q->where('check_in_date', '<=', now())
                      ->where('check_out_date', '>=', now());
                })->where('max_capacity', '>=', 1); // Ensure room has at least 1 capacity
            }])->get()->filter(function ($hotel) use ($numOfPeople) {
                $totalCapacity = $hotel->rooms->sum('max_capacity');
                return $totalCapacity >= $numOfPeople;
            });
        }
    
        if ($request->filled('maxBudget')) {
            $query->whereHas('rooms', function ($q) use ($request) {
                $q->where('adult_price', '<=', $request->input('maxBudget'));
            });
        }
    
        if ($request->filled('checkInDate')) {
            $query->whereHas('rooms', function ($q) use ($request) {
                $q->whereDoesntHave('reservations', function ($q) use ($request) {
                    $q->where('check_in_date', '<=', $request->input('checkInDate'))
                      ->where('check_out_date', '>=', $request->input('checkInDate'));
                });
            });
        }
    
        $hotels2 = $query->with(['rooms', 'services', 'reviews', 'firstPhoto'])->get();
    
        // Extract photo_url and calculate rating for each hotel
        foreach ($hotels2 as $hotel) {
            if (isset($hotel->firstPhoto)) {
                $hotel->photo_url = $hotel->firstPhoto->photo_url;
            }
    
            // Calculate the average rating from reviews
            $hotel->rating = $hotel->reviews->avg('rating') ?? 'No rating available';

            // Calculate the number of available room
        }
    
        $html = view('partials.hotelsSearch', compact('hotels2'))->render();
    
        return response()->json(['html' => $html]);
    }




    public function getHotelDetails($id)
    {
        $hotel = Hotel::findOrFail($id);

        $hotel->load('photos');
        $hotel->load('firstPhoto');
        $hotel->load('reviews');
        $hotel->global_rating = $hotel->reviews->avg('rating') ?? 'No rating available';
        $hotel->load('rooms');
        $hotel->general_price = $hotel->rooms->min('adult_price') ?? 'No price available';
        return view('customers.hotelDetails', compact('hotel'));
    }

/*************************************  main code  ************************************** */



}


