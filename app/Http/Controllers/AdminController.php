<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\HotelManager;


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





public function statistics(){

    // Get the total number of customers and hotels and reservations

    $customers = Customer::count();
    $hotels = Hotel::count();
    $reservations = Reservation::count();
    $hotelManagers = HotelManager::count();

    return view('admins.statistics', compact('customers', 'hotels', 'reservations', 'hotelManagers'));
}


public function showHotelManagers()
{
    $managers = HotelManager::all();
    return view('admins.managerManagement', compact('managers'));
}

public function editHotelManager(Request $request,$id)
{
    // Logic to edit manager
    $manager = HotelManager::find($id);
    if (!$manager) {
        return redirect()->route('managers.list')->with('error', 'Hotel Manager not found');
    }

    return view('admins.editHotelManager', compact('manager'));


}


public function updateHotelManager(Request $request, $id)
{
    $manager = HotelManager::find($id);
    if (!$manager) {
        return redirect()->route('managers.list')->with('error', 'Hotel Manager not found');
    }

    $validator = Validator::make($request->all(), [
        'username' => 'sometimes|required|unique:hotel_managers,username,' . $id . '|max:255',
        'email' => 'sometimes|required|email|unique:hotel_managers,email,' . $id . '|max:255',

    ]);

    if ($validator->fails()) {
        return redirect()->route('managers.edit', $id)
                         ->withErrors($validator)
                         ->withInput();
    }

    $manager->update($request->all());
    return redirect()->route('managers.list')->with('success');
}



public function deleteHotelManager($id)
{
    $manager = HotelManager::find($id);
    if (!$manager) {
        return redirect()->route('managers.list')->with('error', 'Hotel Manager not found');
    }

    $manager->delete();
    return redirect()->route('managers.list')->with('success');
}





public function searchHotelManager(Request $request)
{
    $query = $request->input('search');
    $managers2 = HotelManager::where('username', 'like', '%' . $query . '%')
                            ->orWhere('email', 'like', '%' . $query . '%')
                            ->get();

    $html = view('partials.managersSearch', compact('managers2'))->render();
    return response()->json(['html' => $html]);
}



public function showCustomers(){
    $customers = Customer::all();
    return view('admins.customerManagement', compact('customers'));
}

public function editCustomer(Request $request,$id)
{
    // Logic to edit customer
    $customer = Customer::find($id);
    if (!$customer) {
        return redirect()->route('customers.list')->with('error', 'Customer not found');
    }

    return view('admins.editCustomer', compact('customer'));
}

public function updateCustomer(Request $request, $id)
{
    $customer = Customer::find($id);
    if (!$customer) {
        return redirect()->route('customers.list')->with('error', 'Customer not found');
    }

    $messages = [
        'username.unique' => 'The username has already been taken.',
        'email.unique' => 'The email has already been taken.',
        'birth_date.before' => 'You must be at least 19 years old.',
    ];

    $validator = Validator::make($request->all(), [
        'username' => 'sometimes|required|unique:customers,username,' . $id . '|max:255',
        'email' => 'sometimes|required|email|unique:customers,email,' . $id . '|max:255',
        'birth_date' => 'sometimes|date|before:' . now()->subYears(19)->format('Y-m-d') . '|date_format:Y-m-d',
    ] , $messages);

    if ($validator->fails()) {
        return redirect()->route('customer.edit', $id)
                         ->withErrors($validator)
                         ->withInput();
    }

    $customer->update($request->all());
    return redirect()->route('customers.list')->with('success');
}

public function deleteCustomer($id)
{
    $customer = Customer::find($id);
    if (!$customer) {
        return redirect()->route('customers.list')->with('error', 'Customer not found');
    }

    $customer->delete();
    return redirect()->route('customers.list')->with('success');
}


public function searchCustomer(Request $request)
{
    $query = $request->input('search');
    $customers2 = Customer::where('username', 'like', '%' . $query . '%')
                            ->orWhere('email', 'like', '%' . $query . '%')
                            ->orWhere('birth_date', 'like', '%' . $query . '%')
                            ->get();

    $html = view('partials.customersSearch', compact('customers2'))->render();
    return response()->json(['html' => $html]);
}















    /*************************************************************************************** */
    public function createCustomerAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:customers|max:255',
            'email' => 'required|email|unique:customers|max:255',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->route('customers.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        $customer = Customer::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully');
    }

















/*************************************************************************************** */
    public function updateCustomerAccount($customer_id, Request $request)
    {
        $customer = Customer::find($customer_id);
        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }

        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|required|unique:customers,username,' . $customer_id . '|max:255',
            'email' => 'sometimes|required|email|unique:customers,email,' . $customer_id . '|max:255',
            'password' => 'sometimes|required|min:8',
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