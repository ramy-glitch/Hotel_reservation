<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Details</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="dashboard-container">
    <aside class="sidebar">
        <h2 class="sidebar-logo">Dashboard</h2>
            <ul class="sidebar-menu">
                <li><a href="{{ route('customer.dashboard') }}" class="nav-link">Account Info</a></li>
                <li><a href="{{ route('hotels.index') }}" class="nav-link active">Hotels</a></li>
                <li><a href="#reservations-history" class="nav-link">Reservations History</a></li>
                <li><a href="#notifications" class="nav-link">Notifications</a></li>
            </ul>
            
    </aside>

        <main class="main-content">
            <section id="hotel-details" class="section active">
                <h3> {{ $hotel->hotelname }}</h3>
                <p class="address" style="color: #333;font-size: 1.2rem; margin-bottom: 1rem;">
                    {{ $hotel->location}}
                </p>

                <!-- Image Gallery -->
                <div class="hotel-gallery">
                    <img src="{{ asset('images/' . $hotel->firstPhoto->photo_url) }}" alt="Hotel Image" class="main-image">
                    <div class="thumbnail-gallery">
                        @foreach($hotel->photos as $photo)
                            <img src="{{ asset('images/' . $photo->photo_url) }}" alt="Hotel Thumbnail" class="thumbnail-image">
                        @endforeach
                    </div>
                </div>

                <!-- Hotel Details -->
                <div class="hotel-info">
                    <div class="summary">
                        <span class="rating">Rating: ⭐{{ $hotel->global_rating }}</span>
                        <span class="location-rating">Price: ${{ $hotel->general_price }}/night</span>
                    </div>

                    <h4>Description</h4>
                    <p>Enjoy stunning ocean views and modern amenities for an unforgettable stay at {{ $hotel->hotelname }}.</p>    
                    
                    <h4>Services</h4>
                    <div class="services">
                        @foreach($hotel->availableServices as $service)
                            <span>{{ $service->servicename }}</span>
                        @endforeach
                    </div>

                    <h4>Price</h4>
                    <p>${{ $hotel->general_price }} per night</p>

                    <a href="{{route('customers.booking')}}" class="book-now-button" style="text-decoration: none;">Book Now</a>
                </div>

                <!-- User Reviews Section -->
                <div class="reviews-section"><br><br>
                    <h4>Reviews</h4>

                    <!-- Display Existing Reviews -->
                <div class="existing-reviews">
                    @foreach ($hotel->reviews as $review)
                        <div class="review">
                            <div class="review-header">
                                <span class="review-author"><strong>{{ $review->customer->username }}</strong></span>
                                <span class="review-date">{{ $review->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="review-body">
                                <p>{{ $review->review_comment }}</p>
                            </div>
                            <div class="review-rating">
                                Rating: ⭐{{ $review->rating }}
                            </div>
                            @if(auth()->id() == $review->customer_id)
                                <!-- Update Review Form -->
                                <form action="{{ route('reviews.update', $review->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="comment" rows="2" required>{{ $review->review_comment }}</textarea>
                                    <select name="rating" required>
                                        <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ - Excellent</option>
                                        <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ - Good</option>
                                        <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>⭐⭐⭐ - Average</option>
                                        <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>⭐⭐ - Poor</option>
                                        <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>⭐ - Terrible</option>
                                    </select>
                                    <button type="submit" class="submit-review-button">Update Review</button>
                                </form>

                                <!-- Delete Review Form -->
                                <div class="delete-review-container">
                                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-review-button">Delete Review</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    
                </div>

                    <!-- Add New Review -->
                    @if(!auth()->user()->reviews()->where('hotel_id', $hotel->id)->exists())
                        <div class="add-review">
                            <h5>Leave a Review</h5>
                            <form action="{{ route('reviews.store') }}" method="POST">
                                @csrf
                                <div class="comment-error" style="color: red;">{{ session('error') }}</div>
                                <!-- Hotel ID -->
                                <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">

                                <!-- Comment input -->
                                <label for="comment">Your Comment:</label>
                                <textarea id="comment" name="comment" rows="4" placeholder="Write your review here..." required oninput="updateCommentLength()"></textarea>
                                <div id="comment-length">0/255 characters</div>

                                <!-- Rating -->
                                <label for="rating">Your Rating:</label>
                                <select id="rating" name="rating" required>
                                    <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
                                    <option value="4">⭐⭐⭐⭐ - Good</option>
                                    <option value="3">⭐⭐⭐ - Average</option>
                                    <option value="2">⭐⭐ - Poor</option>
                                    <option value="1">⭐ - Terrible</option>
                                </select>

                                <!-- Submit button -->
                                <button type="submit" class="submit-review-button">Submit Review</button>
                            </form>
                        </div>
                    @endif
                </div>
            </section>
        </main>
    </div>

    <script>
            function updateCommentLength() {
                const comment = document.getElementById('comment');
                const commentLength = document.getElementById('comment-length');
                const maxLength = 255;
                const currentLength = comment.value.length;

                commentLength.textContent = `${currentLength}/${maxLength} characters`;

                if (currentLength > maxLength) {
                    commentLength.style.color = 'red';
                } else {
                    commentLength.style.color = 'black';
                }
            }

            function confirmDelete() {
                return confirm('Are you sure you want to delete this review?');
            }
    </script>

</body>
</html>
