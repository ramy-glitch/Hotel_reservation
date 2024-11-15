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

class CustomerController extends Controller
{

    public function dashboard()
    {
        $customer = Auth::user();
        return view('customers.userDash', compact('customer'));
    }

    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers, 200);
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        return response()->json($customer, 200);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($customer, 201);
    }



    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:customers',
            'password' => 'string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->save();

        return response()->json($customer, 200);
    }


    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully'], 200);
    }





    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['success' => true, 'customer' => $customer], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            return response()->json(['success' => true], 200);
        }

        return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
    }

    public function searchHotels($criteria)
    {
        $hotels = Hotel::where('hotelname', 'like', '%' . $criteria . '%')
                        ->orWhere('location', 'like', '%' . $criteria . '%')
                        ->get();

        return response()->json($hotels, 200);
    }

    public function makeReservation(Request $request, $hotelId)
    {
        $validator = Validator::make($request->all(), [
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date',
            'room_details' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $reservation = Reservation::create([
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'customer_id' => Auth::id(),
            'hotel_id' => $hotelId,
            'status' => 'pending',
            'number_of_adults' => $request->number_of_adults,
            'number_of_children' => $request->number_of_children,
        ]);

        // Assuming room_details is a JSON string with room_id and room_price
        $roomDetails = json_decode($request->room_details, true);
        foreach ($roomDetails as $roomDetail) {
            $reservation->rooms()->attach($roomDetail['room_id'], ['room_price' => $roomDetail['room_price']]);
        }

        return response()->json($reservation, 201);
    }

    public function receiveNotification()
    {
        $notifications = Notification::where('customer_id', Auth::id())->get();
        return response()->json($notifications, 200);
    }

    public function leaveReview(Request $request, $hotelId)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $review = Review::create([
            'rating' => $request->rating,
            'review_comment' => $request->comment,
            'customer_id' => Auth::id(),
            'hotel_id' => $hotelId,
        ]);

        return response()->json($review, 201);
    }
}