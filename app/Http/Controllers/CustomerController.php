<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\Notification;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{

    public function dashboard()
    {
        $customer = Auth::user();
        return view('customers.userDash', compact('customer'));
    }




    public function store(Request $request)
{
    $messages = [
        'birth_date.before' => 'You must be at least 19 years old.',
        'password' => 'The password must contain at least one uppercase letter, one lowercase letter, one special character, and be at least 8 characters long.',
    ];

    $validator = Validator::make($request->all(), [
        'username' => 'required|string|max:255|unique:customers',
        'email' => 'required|string|email|max:255|unique:customers',
        'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).+$/',
        'birth_date' => 'required|date|before:' . now()->subYears(19)->format('Y-m-d') . '|date_format:Y-m-d'
    ], $messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $customer = Customer::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'birth_date' => $request->birth_date,
    ]);

    // Additional logic if needed

    return redirect()->route('login')->with('success', 'Customer created successfully.');
}



public function updateUsernameBirthday(Request $request, $id)
{
    $customer = Customer::find($id);    
    if (!$customer) {
        return response()->json(['error' => 'Customer not found'], 404);
    }

    $messages = [
        'username.unique' => 'The username has already been taken.',
        'dob.before' => 'You must be at least 19 years old.',
    ];

    $validator = Validator::make($request->all(), [
        'username' => 'sometimes|string|max:255|unique:customers',
        'dob' => 'sometimes|date|before:' . now()->subYears(19)->format('Y-m-d') . '|date_format:Y-m-d'
    ], $messages);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    if ($request->has('username')) {
        $customer->username = $request->username;
    }
    if ($request->has('dob')) {
        $customer->birth_date = $request->dob;
    }
    $customer->save();

    return response()->json(['success' => 'Username and birth date updated successfully']);
}


public function updatePassword(Request $request, $id)
{
    $customer = Customer::find($id);
    if (!$customer) {
        return response()->json(['error' => 'Customer not found'], 404);
    }

    $messages = [
        'current-password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one special character, and be at least 8 characters long.',
        'new-password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one special character, and be at least 8 characters long.',
        'new-password.different' => 'The new password must be different from the current password.',
        'confirm-password.same' => 'The confirmation password does not match the new password.',
    ];

    $validator = Validator::make($request->all(), [
        'current-password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).+$/',
        'new-password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).+$/|different:current-password',
        'confirm-password' => 'required|string|same:new-password',
    ], $messages);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Check if the current password matches
    if (!Hash::check($request->input('current-password'), $customer->password)) {
        return response()->json(['error' => 'Current password is incorrect'], 422);
    }

    // Update the password
    $customer->password = bcrypt($request->input('new-password'));
    $customer->save();

    return response()->json(['success' => 'Password updated successfully']);
}


    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        Auth::logout();
        $customer->delete();

        return response()->json(['success' => 'Customer deleted successfully']);
    }


}