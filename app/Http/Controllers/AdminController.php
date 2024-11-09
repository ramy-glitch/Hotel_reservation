<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admins.index', compact('admins'));
    }

    public function show($id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return redirect()->route('admins.index')->with('error', 'Admin not found');
        }
        return view('admins.show', compact('admin'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:admins|max:255',
            'email' => 'required|email|unique:admins|max:255',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admins.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        $admin = Admin::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admins.index')->with('success', 'Admin created successfully');
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return redirect()->route('admins.index')->with('error', 'Admin not found');
        }
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return redirect()->route('admins.index')->with('error', 'Admin not found');
        }

        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|required|unique:admins,username,' . $id . '|max:255',
            'email' => 'sometimes|required|email|unique:admins,email,' . $id . '|max:255',
            'password' => 'sometimes|required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admins.edit', $id)
                             ->withErrors($validator)
                             ->withInput();
        }

        $admin->update($request->all());
        if ($request->has('password')) {
            $admin->password = bcrypt($request->password);
            $admin->save();
        }

        return redirect()->route('admins.index')->with('success', 'Admin updated successfully');
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return redirect()->route('admins.index')->with('error', 'Admin not found');
        }

        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully');
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