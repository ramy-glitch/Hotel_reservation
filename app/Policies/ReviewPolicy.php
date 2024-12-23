<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\Customer; // Use the Customer model
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the customer can update the review.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Review  $review
     * @return mixed
     */
    public function update(Customer $customer, Review $review)
    {
        return $customer->id === $review->customer_id;
    }

    /**
     * Determine whether the customer can delete the review.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Review  $review
     * @return mixed
     */
    public function delete(Customer $customer, Review $review)
    {
        return $customer->id === $review->customer_id;
    }
}