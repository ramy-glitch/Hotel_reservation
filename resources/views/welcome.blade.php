<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservations</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <!-- Navbar -->
    <header>
        <div class="logo">HotelBooking</div>
        <nav>

            <a href="{{ route('welcome') }}">Home</a>
            <a href="#">About Us</a>
            <a href="{{ route('login') }}" class="login-btn">Login</a>
            <a href="{{ route('register') }}" class="register-btn">Register</a>

        </nav>
    </header>

   
    <section class="hero">
        <h1>Find the Perfect Stay for Your Next Trip</h1>
        <p>Discover the best hotels at unbeatable prices. Book your stay now!</p>
        
        <div class="search-bar">
            <input type="text" placeholder="Destination">
            <input type="date" placeholder="Check-in">
            <input type="date" placeholder="Check-out">
            <button>Search Hotels</button>
        </div>
    </section>

    
    <section class="featured-hotels">
        <h2>Top Hotels</h2>
        <p>Explore our selection of popular hotels in various cities.</p>
        
        <div class="hotels">

        @foreach ($hotels as $hotel)    
    <div class="hotel">
    <img src="{{ asset('images/'.$hotel->photo_url) }}" alt="Hotel Image">
                
            <h4>{{ $hotel->hotelname }}</h4>
            <p>Location: {{ $hotel->location }}</p>
            <p>Rating: ⭐{{ $hotel->rating }}</p>
        </div>
        @endforeach
        
    </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="footer-info">
            <div class="footer-logo">HotelBooking</div>
            <p>Your perfect stay is just a click away.</p>
        </div>
        <div class="footer-links">
            <h4>Quick Links</h4>
            <a href="{{ route('welcome') }}">Home</a>
            <a href="#">View Hotels</a>
            <a href="#">Contact Us</a>
        </div>
        <div class="footer-contact">
            <h4>Contact Us</h4>
            <p>Email: support@hotelbooking.com</p>
            <p>Address: 123 Main St, City, Country</p>
        </div>
    </footer>
</body>
</html>
