<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels</title>
    <link rel="stylesheet" href="{{ asset('css/hotel.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <section id="hotels" class="section active">
            <h3>Available Hotels</h3>

            <!-- Updated Filter Bar with More Options -->
            <div class="filter-bar">
                <form id="filter-form">


                    <input type="text" id="hotelname" name="hotelname" class="filter" placeholder="Hotel Name">
                    <input type="text" id="location" name="location" class="filter" placeholder="Location">

                    <select id="rating" name="rating" class="filter">
                        <option value="">Filter by Rating</option>
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="2">2 Stars</option>
                    </select>

                    <input type="text" id="services" name="services" class="filter" placeholder="Services">
                    <input type="number" id="num-of-people" name="numOfPeople" class="filter" placeholder="Number of People">
                    <input type="number" name="maxBudget" placeholder="Max Budget ($)" class="filter" min="0" step="10">
                    <input type="date" id="check-in-date" name="checkInDate" class="filter" placeholder="Check-in Date">
                    <button type="submit" class="filter-button">Apply Filter</button>
                </form>
            </div>

            <div id="hotel-grid" class="hotel-grid">
            @foreach ($hotels as $hotel)
            <div class="hotel-card">
                <img src="{{ asset('images/'.$hotel->photo_url) }}" alt="Hotel Image">
                <div class="hotel-info">
                    <h4>{{ $hotel->hotelname }}</h4>
                    <p>Location: {{ $hotel->location }}</p>
                    <p>Rating: ⭐{{ $hotel->rating }}</p>
                    <a class="details-button" href="{{ route('hotels.hotelDetails', ['id' => $hotel->id]) }}" style="text-decoration: none;">View Details</a>
                </div>
            </div>
            @endforeach
            </div>
        </section>
    </main>

</div>
    <script>
    $(document).ready(function() {
        $('#filter-form').on('submit', function(e) {
            e.preventDefault();

            const params = $(this).serialize();

            $.ajax({
                url: `{{ route('hotels.search') }}?${params}`,
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                },
                success: function(response) {
                    const hotelsContainer = $('#hotel-grid');
                    hotelsContainer.empty();

                    if (response.html.trim() === '') {
                        hotelsContainer.html('<p>No hotels found.</p>');
                    } else {
                        hotelsContainer.html(response.html);
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    });
    </script>
</body>
</html>