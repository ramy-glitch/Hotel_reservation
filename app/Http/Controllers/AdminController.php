<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        return view('admins.index', compact('admin'));
    }

    public function updateUsername(Request $request, $id)
    {
        $admin = Admin::find($id);
        
        $messages = [
            'username.unique' => 'The username has already been taken.',
        ];
    
        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|string|max:255|unique:admins',
        ], $messages);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        if ($request->has('username')) {
            $customer->username = $request->username;
        }
        
        $admin->save();
    
        return response()->json(['success' => 'Username  updated successfully']);
    }

    public function updatePassword(Request $request, $id)
{
    $admin = Admin::find($id);

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
    if (!Hash::check($request->input('current-password'), $admin->password)) {
        return response()->json(['error' => 'Current password is incorrect'], 422);
    }

    // Update the password
    $admin->password = bcrypt($request->input('new-password'));
    $admin->save();

    return response()->json(['success' => 'Password updated successfully']);
}
    





public function destroy($id)
{
    $admin = Admin::find($id);

    Auth::logout();
    $admin->delete();

    return response()->json(['success' => 'Admin deleted successfully']);
}


    public function updateCustomerAccount($customer_id, Request $request)
    {
        $customer = Customer::find($customer_id);
        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }

        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|required|unique:customers,username,' . $customer_id . '|max:255',
            'email' => 'sometimes|required|email|unique:customers,email,' . $customer_id . '|max:255',
            'password' => 'sometimes|required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('customers.edit', $customer_id)
                             ->withErrors($validator)
                             ->withInput();
        }

        $customer->update($request->all());
        if ($request->has('password')) {
            $customer->password = bcrypt($request->password);
            $customer->save();
        }
           
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully');
    }

    public function deleteCustomerAccount($customer_id)
    {
        $customer = Customer::find($customer_id);
        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }

        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }


/*********************************************/ 

    public function createHotelManagerAccount(Request $request)
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

        $manager = HotelManager::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('hotel_managers.index')->with('success', 'Hotel Manager created successfully');
    }

    public function updateHotelManagerAccount($managerId, Request $request)
    {
        $manager = HotelManager::find($managerId);
        if (!$manager) {
            return redirect()->route('hotel_managers.index')->with('error', 'Hotel Manager not found');
        }


        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|required|unique:hotel_managers,username,' . $managerId . '|max:255',
            'email' => 'sometimes|required|email|unique:hotel_managers,email,' . $managerId . '|max:255',
            'password' => 'sometimes|required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('hotel_managers.edit', $managerId)
                             ->withErrors($validator)
                             ->withInput();
        }

        $manager->update($request->all());
        if ($request->has('password')) {
            $manager->password = bcrypt($request->password);
            $manager->save();
        }

        return redirect()->route('hotel_managers.index')->with('success', 'Hotel Manager updated successfully');
    }

    public function deleteHotelManagerAccount($managerId)
    {
        $manager = HotelManager::find($managerId);
        if (!$manager) {
            return redirect()->route('hotel_managers.index')->with('error', 'Hotel Manager not found');
        }

        $manager->delete();
        return redirect()->route('hotel_managers.index')->with('success', 'Hotel Manager deleted successfully');
    }

}