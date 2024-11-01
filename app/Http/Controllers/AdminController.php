<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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
}