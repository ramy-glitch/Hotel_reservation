<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Stay</title>
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
            <section id="booking-section" class="section active">
                <h3>Book Your Stay</h3>

                <form action="confirmation.html" method="post">
                    <!-- Date Selection -->
                    <label for="checkin-date">Check-in Date:</label>
                    <input type="date" id="checkin-date" name="checkin-date" required>

                    <label for="checkout-date">Check-out Date:</label>
                    <input type="date" id="checkout-date" name="checkout-date" required>

                    <!-- Number of Guests -->
                    <label for="adults">Number of Adults:</label>
                    <input type="number" id="adults" name="adults" min="1" max="10" required>

                    <label for="children">Number of Children:</label>
                    <input type="number" id="children" name="children" min="0" max="10">

                    <!-- Room Selection -->
                    <label for="rooms">Number of Rooms:</label>
                    <input type="number" id="rooms" name="rooms" min="1" max="5" required>

                    <label for="room-type">Room Type:</label>
                    <select id="room-type" name="room-type" required>
                        <option value="single">Single Room</option>
                        <option value="double">Double Room</option>
                        <option value="suite">Suite</option>
                        <option value="family">Family Room</option>
                    </select>

                    
                    <button type="submit" class="confirm-booking-button">Confirm Booking</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
