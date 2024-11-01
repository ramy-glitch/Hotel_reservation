<?php

namespace App\Http\Controllers;

use App\Models\HotelManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelManagerController extends Controller
{
    public function index()
    {
        $hotelManagers = HotelManager::all();
        return response()->json($hotelManagers);
    }

    public function show($id)
    {
        $hotelManager = HotelManager::find($id);
        if (!$hotelManager) {
            return response()->json(['message' => 'Hotel Manager not found'], 404);
        }
        return response()->json($hotelManager);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:hotel_managers|max:255',
            'email' => 'required|email|unique:hotel_managers|max:255',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $hotelManager = HotelManager::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($hotelManager, 201);
    }

    public function update(Request $request, $id)
    {
        $hotelManager = HotelManager::find($id);
        if (!$hotelManager) {
            return response()->json(['message' => 'Hotel Manager not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|required|unique:hotel_managers,username,' . $id . '|max:255',
            'email' => 'sometimes|required|email|unique:hotel_managers,email,' . $id . '|max:255',
            'password' => 'sometimes|required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $hotelManager->update($request->all());
        if ($request->has('password')) {
            $hotelManager->password = bcrypt($request->password);
            $hotelManager->save();
        }

        return response()->json($hotelManager, 200);
    }

    public function destroy($id)
    {
        $hotelManager = HotelManager::find($id);
        if (!$hotelManager) {
            return response()->json(['message' => 'Hotel Manager not found'], 404);
        }

        $hotelManager->delete();
        return response()->json(null, 204);
    }
}