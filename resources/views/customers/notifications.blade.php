<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
</head>
<body>
    <div class="dashboard-container">
       
        <aside class="sidebar">
            <h2 class="sidebar-logo">Dashboard</h2>
            <ul class="sidebar-menu">
            <li><a href="{{ route('customer.dashboard') }}" class="nav-link ">Account Info</a></li>
                <li><a href="{{ route('hotels.index') }}" class="nav-link">Hotels</a></li>
                <li><a href="{{ route('customers.reservationHistory') }}" class="nav-link">Reservations History</a></li>
                <li><a href="{{ route('customers.notifications') }}" class="nav-link active">Notifications</a></li>
            </ul>
        </aside>

       
        <main class="main-content">
            <section id="notifications" class="section active">
                <h3>Notifications</h3>

                <div class="notification-item">
                    <h4>System Update</h4>
                    <p>Your system will be updated on 2023-10-30 at 2:00 AM. Please save your work.</p>
                    <span class="timestamp">10 mins ago</span>
                </div>

                <div class="notification-item">
                    <h4>New Reservation</h4>
                    <p>Your reservation at Ocean View Resort has been confirmed. Check-in date: 2023-11-01.</p>
                    <span class="timestamp">1 hour ago</span>
                </div>
                
            </section>
        </main>
    </div>
</body>
</html>
