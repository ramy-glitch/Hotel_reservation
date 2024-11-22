<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels</title>
    <link rel="stylesheet" href="{{ asset('css/hotel.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <h2 class="sidebar-logo">Dashboard</h2>
            <ul class="sidebar-menu">
                <li><a href="{{ route('customer.dashboard') }}" class="nav-link">Account Info</a></li>
                <li><a href="{{ route('hotels.index') }}" class="nav-link active">Hotels</a></li>
                <li><a href="#" class="nav-link">Reservations History</a></li>
                <li><a href="#" class="nav-link">Notifications</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <section id="hotels" class="section active">
                <h3>Available Hotels</h3>

                <!-- Updated Filter Bar with More Options -->
                <div class="filter-bar">
                    
                    <form id="filter-form">
                        <input type="text" placeholder="Search hotels..." class="search-bar">

                        <select class="filter">
                            <option value="">Filter by Rating</option>
                            <option value="5">5 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="2">2 Stars</option>
                        </select>

                        <input type="text" id="location" class="filter" placeholder="Location">

                        <input type="number" id="num-of-people" class="filter" placeholder="Number of People">


                        <input type="number" placeholder="Max Budget ($)" class="filter" min="0" step="10">

                        
                        <input type="date" id="Check-in Date" class="filter" placeholder="Check-in Date">

                        <button type="submit" class="filter-button">Apply Filter</button>
                    </form>
                    
                </div>

                <!-- Hotel Grid -->
                <div class="hotel-grid">
                    @foreach ($hotels as $hotel)
                        <div class="hotel-card">
                            <img src="{{ asset('images/'. $hotel->photo) }}" alt="Hotel Image">
                            <div class="hotel-info">
                                <h4>{{ $hotel->name }}</h4>
                                <p>Location: {{ $hotel->location }}</p>
                                <p>Rating: ⭐{{ $hotel->rating }}</p>
                                <button class="details-button" onclick="location.href='#'">View Details</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
    </div>

    
</body>
</html>
