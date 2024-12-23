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
        ]);
    
        $review = new Review();
        $review->review_comment  = $request->comment;
        $review->rating = $request->rating;
        $review->customer_id = auth()->id(); // Assuming the user is authenticated
        $review->hotel_id = $request->hotel_id; // Make sure to pass the hotel_id in the form
    
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