<?php

namespace App\Http\Controllers;

use App\Models\HotelManager;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Service;
use App\Models\HotelPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HotelManagerController extends Controller
{
    public function index()
    {
        $hotelManager = Auth::user();
        return view('hotelManagers.index', compact('hotelManager'));
    }

    public function updateUsername(Request $request, $id)
    {
        $hotelManager = HotelManager::find($id);
        
        $messages = [
            'username.unique' => 'The username has already been taken.',
        ];
    
        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|string|max:255|unique:hotel_managers',
        ], $messages);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        if ($request->has('username')) {
            $hotelManager->username = $request->username;
        }
        
        $hotelManager->save();
    
        return response()->json(['success' => 'Username  updated successfully']);
    }

    public function updatePassword(Request $request, $id)
{
    $hotelManager = HotelManager::find($id);

    $messages = [
        'new-password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one special character, and be at least 8 characters long.',
        'new-password.different' => 'The new password must be different from the current password.',
        'confirm-password.same' => 'The confirmation password does not match the new password.',
    ];

    $validator = Validator::make($request->all(), [
        'current-password' => 'required|string',
        'new-password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).+$/|different:current-password',
        'confirm-password' => 'required|string|same:new-password',
    ], $messages);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Check if the current password matches
    if (!Hash::check($request->input('current-password'), $hotelManager->password)) {
        return response()->json(['error' => 'Current password is incorrect'], 422);
    }

    // Update the password
    $hotelManager->password = bcrypt($request->input('new-password'));
    $hotelManager->save();

    return response()->json(['success' => 'Password updated successfully']);
}
    





public function destroy($id)
{
    $hotelManager = HotelManager::find($id);

    Auth::logout();
    $hotelManager->delete();

    return response()->json(['success' => 'Hotel manager deleted successfully']);
}














    /******************************************** */

    public function storehotel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hotelname' => 'required|max:255',
            'location' => 'required|max:255',
            'child_age_limit' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->route('hotels.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        $hotel = Hotel::create([
            'hotelname' => $request->hotelname,
            'location' => $request->location,
            'child_age_limit' => $request->child_age_limit,
            'manager_id' => auth()->id(),
        ]);

        return redirect()->route('hotels.index')->with('success', 'Hotel added successfully');
    }

    public function edithotel($id)
    {
        $hotel = Hotel::where('id', $id)->where('manager_id', auth()->id())->first();
        if (!$hotel) {
            return redirect()->route('hotels.index')->with('error', 'Hotel not found or you do not have permission to edit this hotel');
        }
        return view('hotels.edit', compact('hotel'));
    }

    public function updatehotel(Request $request, $id)
    {
        $hotel = Hotel::where('id', $id)->where('manager_id', auth()->id())->first();
        if (!$hotel) {
            return redirect()->route('hotels.index')->with('error', 'Hotel not found or you do not have permission to update this hotel');
        }

        $validator = Validator::make($request->all(), [
            'hotelname' => 'sometimes|required|max:255',
            'location' => 'sometimes|required|max:255',
            'child_age_limit' => 'sometimes|required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->route('hotels.edit', $id)
                             ->withErrors($validator)
                             ->withInput();
        }

        $hotel->update($request->all());
        return redirect()->route('hotels.index')->with('success', 'Hotel updated successfully');
    }

    public function destroyhotel($id)
    {
        $hotel = Hotel::where('id', $id)->where('manager_id', auth()->id())->first();
        if (!$hotel) {
            return redirect()->route('hotels.index')->with('error', 'Hotel not found or you do not have permission to delete this hotel');
        }

        $hotel->delete();
        return redirect()->route('hotels.index')->with('success', 'Hotel deleted successfully');
    }

    public function addRoom($hotelId, Request $request)
    {
        $hotel = Hotel::where('id', $hotelId)->where('manager_id', auth()->id())->first();
        if (!$hotel) {
            return redirect()->route('hotels.index')->with('error', 'Hotel not found or you do not have permission to add a room to this hotel');
        }

        $validator = Validator::make($request->all(), [
            'room_number' => 'required|max:255',
            'room_type' => 'required|max:255',
            'standard_capacity' => 'required|integer',
            'max_capacity' => 'required|integer',
            'adult_price' => 'required|numeric',
            'child_price' => 'required|numeric',
            'availability' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->route('rooms.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        $room = Room::create([
            'room_number' => $request->room_number,
            'room_type' => $request->room_type,
            'standard_capacity' => $request->standard_capacity,
            'max_capacity' => $request->max_capacity,
            'adult_price' => $request->adult_price,
            'child_price' => $request->child_price,
            'availability' => $request->availability,
            'hotel_id' => $hotelId,
        ]);

        return redirect()->route('hotels.show', $hotelId)->with('success', 'Room added successfully');
    }

    public function updateRoom($roomId, Request $request)
    {
        $room = Room::find($roomId);
        if (!$room || $room->hotel->manager_id != auth()->id()) {
            return redirect()->route('hotels.index')->with('error', 'Room not found or you do not have permission to update this room');
        }

        $validator = Validator::make($request->all(), [
            'room_number' => 'sometimes|required|max:255',
            'room_type' => 'sometimes|required|max:255',
            'standard_capacity' => 'sometimes|required|integer',
            'max_capacity' => 'sometimes|required|integer',
            'adult_price' => 'sometimes|required|numeric',
            'child_price' => 'sometimes|required|numeric',
            'availability' => 'sometimes|required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->route('rooms.edit', $roomId)
                            ->withErrors($validator)
                            ->withInput();
        }

        $room->update($request->all());
        return redirect()->route('hotels.show', $room->hotel_id)->with('success', 'Room updated successfully');
    }

    public function deleteRoom($roomId)
    {
        $room = Room::find($roomId);
        if (!$room || $room->hotel->manager_id != auth()->id()) {
            return redirect()->route('hotels.index')->with('error', 'Room not found or you do not have permission to delete this room');
        }

        $room->delete();
        return redirect()->route('hotels.show', $room->hotel_id)->with('success', 'Room deleted successfully');
    }

    public function addService($hotelId, Request $request)
    {
        $hotel = Hotel::where('id', $hotelId)->where('manager_id', auth()->id())->first();
        if (!$hotel) {
            return redirect()->route('hotels.index')->with('error', 'Hotel not found or you do not have permission to add a service to this hotel');
        }

        $validator = Validator::make($request->all(), [
            'servicename' => 'required|max:255',
            'description' => 'nullable',
            'availability' => 'required|boolean',
            'cost' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('services.create')
                            ->withErrors($validator)
                            ->withInput();
        }

        $service = Service::create([
            'servicename' => $request->servicename,
            'description' => $request->description,
            'availability' => $request->availability,
            'cost' => $request->cost,
            'hotel_id' => $hotelId,
        ]);

        return redirect()->route('hotels.show', $hotelId)->with('success', 'Service added successfully');
    }

    public function updateService($serviceId, Request $request)
    {
        $service = Service::find($serviceId);
        if (!$service || $service->hotel->manager_id != auth()->id()) {
            return redirect()->route('hotels.index')->with('error', 'Service not found or you do not have permission to update this service');
        }

        $validator = Validator::make($request->all(), [
            'servicename' => 'sometimes|required|max:255',
            'description' => 'nullable',
            'availability' => 'sometimes|required|boolean',
            'cost' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('services.edit', $serviceId)
                             ->withErrors($validator)
                             ->withInput();
        }

        $service->update($request->all());
        return redirect()->route('hotels.show', $service->hotel_id)->with('success', 'Service updated successfully');
    }

    public function deleteService($serviceId)
    {
        $service = Service::find($serviceId);
        if (!$service || $service->hotel->manager_id != auth()->id()) {
            return redirect()->route('hotels.index')->with('error', 'Service not found or you do not have permission to delete this service');
        }

        $service->delete();
        return redirect()->route('hotels.show', $service->hotel_id)->with('success', 'Service deleted successfully');
    }

    public function addPhoto($hotelId, Request $request)
    {
        $hotel = Hotel::where('id', $hotelId)->where('manager_id', auth()->id())->first();
        if (!$hotel) {
            return redirect()->route('hotels.index')->with('error', 'Hotel not found or you do not have permission to add a photo to this hotel');
        }

        $validator = Validator::make($request->all(), [
            'photo_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return redirect()->route('hotels.show', $hotelId)
                             ->withErrors($validator)
                             ->withInput();
        }

        HotelPhoto::create([
            'hotel_id' => $hotelId,
            'photo_url' => $request->photo_url,
        ]);

        return redirect()->route('hotels.show', $hotelId)->with('success', 'Photo added successfully');
    }
}