<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Details</title>
    <link rel="stylesheet" href="style.css">
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
                <h3>{{ $hotel->name }}</h3>
                <p class="address">
                    {{ $hotel->location}}
                </p>

                <!-- Image Gallery -->
                <div class="hotel-gallery">
                    <img src="hotel_main.jpg" alt="Hotel Main Image" class="main-image">
                    <div class="thumbnail-gallery">
                        @foreach($hotel->photos as $photo)
                            <img src="{{ asset('images/' . $photo->photo_url) }}" alt="Hotel Thumbnail" class="thumbnail-image">
                        @endforeach
                    </div>
                </div>

                <!-- Hotel Details -->
                <div class="hotel-info">
                    <div class="summary">
                        <span class="rating">Pleasant 6.4</span>
                        <span class="location-rating">Great location! 8.3</span>
                    </div>

                    <h4>Description</h4>
                    <p>Enjoy stunning ocean views and modern amenities for an unforgettable stay at Ocean View Resort.</p>
                    
                    <h4>Services</h4>
                    <div class="services">
                        <span>Breakfast</span>
                        <span>2 Restaurants</span>
                        <span>Private Bathroom</span>
                        <span>Ocean View</span>
                        <span>Free Wi-Fi</span>
                        <span>Airport Shuttle (free)</span>
                        <span>Air Conditioning</span>
                        <span>Non-Smoking Rooms</span>
                    </div>

                    <h4>Price</h4>
                    <p>$200 per night</p>

                    <a href="booking.html" class="book-now-button">Book Now</a>
                </div>

                <!-- User Reviews Section -->
                <div class="reviews-section">
                    <h4>Reviews</h4>

                    <!-- Display Existing Reviews -->
                    <div class="existing-reviews">
                        <p><strong>John Doe:</strong> Amazing hotel! The view is breathtaking. Highly recommend. ⭐⭐⭐⭐</p>
                        <p><strong>Jane Smith:</strong> Great location, but the room service could be better. ⭐⭐⭐</p>
                    </div>

                    <!-- Add New Review -->
                    <div class="add-review">
                        <h5>Leave a Review</h5>
                        <form action="submit-review.php" method="POST">
                            <!-- Comment input -->
                            <label for="comment">Your Comment:</label>
                            <textarea id="comment" name="comment" rows="4" placeholder="Write your review here..." required></textarea>

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
                </div>
            </section>
        </main>
    </div>
</body>
</html>
