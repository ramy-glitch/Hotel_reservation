<?php

namespace App\Http\Controllers;

use App\Models\RoomPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomPhotoController extends Controller
{
    public function index()
    {
        $roomPhotos = RoomPhoto::all();
        return response()->json($roomPhotos);
    }

    public function show($id)
    {
        $roomPhoto = RoomPhoto::find($id);
        if (!$roomPhoto) {
            return response()->json(['message' => 'Room Photo not found'], 404);
        }
        return response()->json($roomPhoto);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo_url' => 'required|url',
            'room_id' => 'required|exists:rooms,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $roomPhoto = RoomPhoto::create($request->all());
        return response()->json($roomPhoto, 201);
    }

    public function update(Request $request, $id)
    {
        $roomPhoto = RoomPhoto::find($id);
        if (!$roomPhoto) {
            return response()->json(['message' => 'Room Photo not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'photo_url' => 'sometimes|required|url',
            'room_id' => 'sometimes|required|exists:rooms,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $roomPhoto->update($request->all());
        return response()->json($roomPhoto, 200);
    }

    public function destroy($id)
    {
        $roomPhoto = RoomPhoto::find($id);
        if (!$roomPhoto) {
            return response()->json(['message' => 'Room Photo not found'], 404);
        }

        $roomPhoto->delete();
        return response()->json(null, 204);
    }
}