<?php

namespace App\Http\Controllers;

use App\Models\HotelPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelPhotoController extends Controller
{
    public function index()
    {
        $hotelPhotos = HotelPhoto::all();
        return response()->json($hotelPhotos);
    }

    public function show($id)
    {
        $hotelPhoto = HotelPhoto::find($id);
        if (!$hotelPhoto) {
            return response()->json(['message' => 'Hotel Photo not found'], 404);
        }
        return response()->json($hotelPhoto);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo_url' => 'required',
            'hotel_id' => 'required|exists:hotels,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $hotelPhoto = HotelPhoto::create($request->all());
        return response()->json($hotelPhoto, 201);
    }

    public function update(Request $request, $id)
    {
        $hotelPhoto = HotelPhoto::find($id);
        if (!$hotelPhoto) {
            return response()->json(['message' => 'Hotel Photo not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'photo_url' => 'sometimes|required',
            'hotel_id' => 'sometimes|required|exists:hotels,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $hotelPhoto->update($request->all());
        return response()->json($hotelPhoto, 200);
    }

    public function destroy($id)
    {
        $hotelPhoto = HotelPhoto::find($id);
        if (!$hotelPhoto) {
            return response()->json(['message' => 'Hotel Photo not found'], 404);
        }

        $hotelPhoto->delete();
        return response()->json(null, 204);
    }
}