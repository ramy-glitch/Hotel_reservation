<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller; 

class ReviewController extends Controller
{


    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'hotel_id' => 'required|exists:hotels,id', // Validate that hotel_id is required and exists in the hotels table
        ]);

        $customer_id = auth()->id();
        $hotel_id = $request->hotel_id;

        // Check if the customer has already commented on this hotel
        $existingReview = Review::where('customer_id', $customer_id)
                                ->where('hotel_id', $hotel_id)
                                ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already submitted a review for this hotel.');
        }

        $review = new Review();
        $review->review_comment  = $request->comment;
        $review->rating = $request->rating;
        $review->customer_id = $customer_id;
        $review->hotel_id = $hotel_id;

        $review->save();
        return redirect()->back()->with('success', 'Review submitted successfully!');
    }


        public function update(Request $request, Review $review)
    {
        $this->authorize('update', $review); // Ensure the user is authorized to update the review

        $request->validate([
            'comment' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review->review_comment = $request->comment;
        $review->rating = $request->rating;
        $review->save();

        return redirect()->back()->with('success', 'Review updated successfully!');
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review); // Ensure the user is authorized to delete the review

        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully!');
    }

/*************************************treat it later*************************** */
    public function index()
    {
        $reviews = Review::all();
        return response()->json($reviews);
    }

    public function show($id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }
        return response()->json($review);
    }




    /*************************************treat it later*************************** */
}