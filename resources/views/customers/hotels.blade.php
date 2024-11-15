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
                <li><a href="{{ route('reservations.index') }}" class="nav-link">Reservations History</a></li>
                <li><a href="{{ route('notifications.index') }}" class="nav-link">Notifications</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <section id="hotels" class="section active">
                <h3>Available Hotels</h3>

                <!-- Updated Filter Bar with More Options -->
                <div class="filter-bar">
                    <input type="text" placeholder="Search hotels..." class="search-bar">

                    <select class="filter">
                        <option value="">Filter by Rating</option>
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                    </select>

                    <select class="filter">
                        <option value="">Filter by Location</option>
                        <option value="city1">City 1</option>
                        <option value="city2">City 2</option>
                        <option value="city3">City 3</option>
                    </select>

                    <select class="filter">
                        <option value="">Number of People</option>
                        <option value="1">1 Person</option>
                        <option value="2">2 People</option>
                        <option value="3">3 People</option>
                        <option value="4">4+ People</option>
                    </select>

                    <input type="number" placeholder="Max Budget ($)" class="filter" min="0" step="10">

                    <label for="availability-date"></label>
                    <input type="date" id="availability-date" class="filter">

                    <button class="filter-button">Apply Filter</button>
                </div>

                <!-- Hotel Grid -->
                <div class="hotel-grid">
                    @foreach ($hotels as $hotel)
                        <div class="hotel-card">
                            <img src="{{ asset('images/' . $hotel->image) }}" alt="Hotel Image">
                            <div class="hotel-info">
                                <h4>{{ $hotel->name }}</h4>
                                <p>Location: {{ $hotel->location }}</p>
                                <p>Rating: ⭐{{ $hotel->rating }}</p>
                                <button class="details-button" onclick="location.href='{{ route('hotels.show', $hotel->id) }}'">View Details</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
