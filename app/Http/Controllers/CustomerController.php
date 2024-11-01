<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }
        return view('customers.show', compact('customer'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:customers|max:255',
            'email' => 'required|email|unique:customers|max:255',
            'password' => 'required|min:6',
            'birth_date' => ['required', 'date', function ($attribute, $value, $fail) {
                if (now()->diffInYears($value) < 19) {
                    $fail('The customer must be at least 19 years old.');
                }
            }],
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
            'birth_date' => $request->birth_date,
        ]);
    
        return redirect()->route('customers.index')->with('success', 'Customer created successfully');
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }
    
        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|required|unique:customers,username,' . $id . '|max:255',
            'email' => 'sometimes|required|email|unique:customers,email,' . $id . '|max:255',
            'password' => 'sometimes|required|min:6',
            'birth_date' => ['sometimes', 'required', 'date', function ($attribute, $value, $fail) {
                if (now()->diffInYears($value) < 19) {
                    $fail('The customer must be at least 19 years old.');
                }
            }],
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('customers.edit', $id)
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

    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }

        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }
}