<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
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
        return view('hotels.index', compact('hotels'));
    }

    public function show($id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return redirect()->route('hotels.index')->with('error', 'Hotel not found');
        }
        return view('hotels.show', compact('hotel'));
    }

    public function create()
    {
        return view('hotels.create');
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
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return redirect()->route('hotels.index')->with('error', 'Hotel not found');
        }
        return view('hotels.details', compact('hotel'));
    }

    public function getRooms($id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return redirect()->route('hotels.index')->with('error', 'Hotel not found');
        }
        $rooms = Room::where('hotel_id', $id)->get();
        return view('rooms.index', compact('rooms', 'hotel'));
    }

    public function getServices($id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return redirect()->route('hotels.index')->with('error', 'Hotel not found');
        }
        $services = Service::where('hotel_id', $id)->get();
        return view('services.index', compact('services', 'hotel'));
    }

    public function getReviews($id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return redirect()->route('hotels.index')->with('error', 'Hotel not found');
        }
        $reviews = Review::where('hotel_id', $id)->get();
        return view('reviews.index', compact('reviews', 'hotel'));
    }
}