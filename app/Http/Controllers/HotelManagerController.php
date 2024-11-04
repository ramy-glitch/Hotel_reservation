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
        return view('hotel_managers.index', compact('hotelManagers'));
    }

    public function show($id)
    {
        $hotelManager = HotelManager::find($id);
        if (!$hotelManager) {
            return redirect()->route('hotel_managers.index')->with('error', 'Hotel Manager not found');
        }
        return view('hotel_managers.show', compact('hotelManager'));
    }

    public function create()
    {
        return view('hotel_managers.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:hotel_managers|max:255',
            'email' => 'required|email|unique:hotel_managers|max:255',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('hotel_managers.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        $hotelManager = HotelManager::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('hotel_managers.index')->with('success', 'Hotel Manager created successfully');
    }

    public function edit($id)
    {
        $hotelManager = HotelManager::find($id);
        if (!$hotelManager) {
            return redirect()->route('hotel_managers.index')->with('error', 'Hotel Manager not found');
        }
        return view('hotel_managers.edit', compact('hotelManager'));
    }

    public function update(Request $request, $id)
    {
        $hotelManager = HotelManager::find($id);
        if (!$hotelManager) {
            return redirect()->route('hotel_managers.index')->with('error', 'Hotel Manager not found');
        }

        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|required|unique:hotel_managers,username,' . $id . '|max:255',
            'email' => 'sometimes|required|email|unique:hotel_managers,email,' . $id . '|max:255',
            'password' => 'sometimes|required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('hotel_managers.edit', $id)
                             ->withErrors($validator)
                             ->withInput();
        }

        $hotelManager->update($request->all());
        if ($request->has('password')) {
            $hotelManager->password = bcrypt($request->password);
            $hotelManager->save();
        }

        return redirect()->route('hotel_managers.index')->with('success', 'Hotel Manager updated successfully');
    }

    public function destroy($id)
    {
        $hotelManager = HotelManager::find($id);
        if (!$hotelManager) {
            return redirect()->route('hotel_managers.index')->with('error', 'Hotel Manager not found');
        }

        $hotelManager->delete();
        return redirect()->route('hotel_managers.index')->with('success', 'Hotel Manager deleted successfully');
    }
}