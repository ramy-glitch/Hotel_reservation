<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return response()->json($rooms);
    }

    public function show($id)
    {
        $room = Room::find($id);
        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }
        return response()->json($room);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_number' => 'required|max:255',
            'room_type' => 'required|max:255',
            'standard_capacity' => 'required|integer',
            'max_capacity' => 'required|integer',
            'adult_price' => 'required|numeric',
            'child_price' => 'required|numeric',
            'availability' => 'required|boolean',
            'hotel_id' => 'required|exists:hotels,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $room = Room::create($request->all());
        return response()->json($room, 201);
    }

    public function update(Request $request, $id)
    {
        $room = Room::find($id);
        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'room_number' => 'sometimes|required|max:255',
            'room_type' => 'sometimes|required|max:255',
            'standard_capacity' => 'sometimes|required|integer',
            'max_capacity' => 'sometimes|required|integer',
            'adult_price' => 'sometimes|required|numeric',
            'child_price' => 'sometimes|required|numeric',
            'availability' => 'sometimes|required|boolean',
            'hotel_id' => 'sometimes|required|exists:hotels,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $room->update($request->all());
        return response()->json($room, 200);
    }

    public function destroy($id)
    {
        $room = Room::find($id);
        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }

        $room->delete();
        return response()->json(null, 204);
    }
}