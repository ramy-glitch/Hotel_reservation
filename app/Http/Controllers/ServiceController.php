<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return response()->json($services);
    }

    public function show($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }
        return response()->json($service);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'servicename' => 'required|max:255',
            'description' => 'nullable',
            'availability' => 'required|boolean',
            'cost' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $service = Service::create($request->all());
        return response()->json($service, 201);
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'servicename' => 'sometimes|required|max:255',
            'description' => 'nullable',
            'availability' => 'sometimes|required|boolean',
            'cost' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $service->update($request->all());
        return response()->json($service, 200);
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $service->delete();
        return response()->json(null, 204);
    }
}