<?php

namespace App\Http\Controllers;

use App\Models\ReservationRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationRoomController extends Controller
{
    public function index()
    {
        $reservationRooms = ReservationRoom::all();
        return response()->json($reservationRooms);
    }

    public function show($reservation_id, $room_id)
    {
        $reservationRoom = ReservationRoom::where('reservation_id', $reservation_id)
                                          ->where('room_id', $room_id)
                                          ->first();
        if (!$reservationRoom) {
            return response()->json(['message' => 'Reservation Room not found'], 404);
        }
        return response()->json($reservationRoom);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reservation_id' => 'required|exists:reservations,id',
            'room_id' => 'required|exists:rooms,id',
            'room_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $reservationRoom = ReservationRoom::create($request->all());
        return response()->json($reservationRoom, 201);
    }

    public function update(Request $request, $reservation_id, $room_id)
    {
        $reservationRoom = ReservationRoom::where('reservation_id', $reservation_id)
                                          ->where('room_id', $room_id)
                                          ->first();
        if (!$reservationRoom) {
            return response()->json(['message' => 'Reservation Room not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'reservation_id' => 'sometimes|required|exists:reservations,id',
            'room_id' => 'sometimes|required|exists:rooms,id',
            'room_price' => 'sometimes|required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $reservationRoom->update($request->all());
        return response()->json($reservationRoom, 200);
    }

    public function destroy($reservation_id, $room_id)
    {
        $reservationRoom = ReservationRoom::where('reservation_id', $reservation_id)
                                          ->where('room_id', $room_id)
                                          ->first();
        if (!$reservationRoom) {
            return response()->json(['message' => 'Reservation Room not found'], 404);
        }

        $reservationRoom->delete();
        return response()->json(null, 204);
    }
}