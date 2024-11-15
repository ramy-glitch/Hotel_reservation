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


    public function show($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found');
        }

        return view('customers.show', compact('customer'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('customers.show', $customer->id)->with('success', 'Customer created successfully');
    }



    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:customers',
            'password' => 'string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->save();

        return redirect()->route('customers.show', $customer->id)->with('success', 'Customer updated successfully');
    }


    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found');
        }

        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }





    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('customers.show', $customer->id)->with('success', 'Customer registered successfully');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route('dashboard')->with('success', 'Login successful');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function searchHotels($criteria)
    {
        $hotels = Hotel::where('hotelname', 'like', '%' . $criteria . '%')
                        ->orWhere('location', 'like', '%' . $criteria . '%')
                        ->get();

        return view('hotels.index', compact('hotels'));
    }

    public function makeReservation(Request $request, $hotelId)
    {
        $validator = Validator::make($request->all(), [
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date',
            'room_details' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
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

        return redirect()->route('reservations.show', $reservation->id)->with('success', 'Reservation made successfully');
    }

    public function receiveNotification()
    {
        $notifications = Notification::where('customer_id', Auth::id())->get();
        return view('notifications.index', compact('notifications'));
    }

    public function leaveReview(Request $request, $hotelId)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $review = Review::create([
            'rating' => $request->rating,
            'review_comment' => $request->comment,
            'customer_id' => Auth::id(),
            'hotel_id' => $hotelId,
        ]);

        return redirect()->route('hotels.show', $hotelId)->with('success', 'Review submitted successfully');
    }
}