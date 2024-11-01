<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return response()->json($reservations);
    }

    public function show($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }
        return response()->json($reservation);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'hotel_id' => 'required|exists:hotels,id',
            'status' => 'required|max:255',
            'number_of_adults' => 'required|integer',
            'number_of_children' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $reservation = Reservation::create($request->all());
        return response()->json($reservation, 201);
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'check_in_date' => 'sometimes|required|date',
            'check_out_date' => 'sometimes|required|date',
            'customer_id' => 'sometimes|required|exists:customers,id',
            'hotel_id' => 'sometimes|required|exists:hotels,id',
            'status' => 'sometimes|required|max:255',
            'number_of_adults' => 'sometimes|required|integer',
            'number_of_children' => 'sometimes|required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $reservation->update($request->all());
        return response()->json($reservation, 200);
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $reservation->delete();
        return response()->json(null, 204);
    }
}