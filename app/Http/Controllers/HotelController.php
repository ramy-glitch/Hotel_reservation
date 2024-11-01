<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return response()->json($hotels);
    }

    public function show($id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return response()->json(['message' => 'Hotel not found'], 404);
        }
        return response()->json($hotel);
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
            return response()->json($validator->errors(), 400);
        }

        $hotel = Hotel::create($request->all());
        return response()->json($hotel, 201);
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return response()->json(['message' => 'Hotel not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'hotelname' => 'sometimes|required|max:255',
            'location' => 'sometimes|required|max:255',
            'child_age_limit' => 'sometimes|required|integer',
            'manager_id' => 'nullable|exists:hotel_managers,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $hotel->update($request->all());
        return response()->json($hotel, 200);
    }

    public function destroy($id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return response()->json(['message' => 'Hotel not found'], 404);
        }

        $hotel->delete();
        return response()->json(null, 204);
    }
}