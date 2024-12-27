<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations History</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2 class="sidebar-logo">Dashboard</h2>
            <ul class="sidebar-menu">
                <li><a href="{{ route('customer.dashboard') }}" class="nav-link ">Account Info</a></li>
                <li><a href="{{ route('hotels.index') }}" class="nav-link">Hotels</a></li>
                <li><a href="{{ route('customers.reservationHistory') }}" class="nav-link active">Reservations History</a></li>
                <li><a href="{{ route('customers.notifications') }}" class="nav-link">Notifications</a></li>
            </ul>
        </aside>

        
        <main class="main-content">
            <section id="reservations-history" class="section active">
                <h3>Reservations History</h3>

              
                <div class="reservation-item">
                    <div class="reservation-info">
                        <h4>Ocean View Resort</h4>
                        <p>Location: Miami, USA</p>
                        <p>Check-in Date: 2023-11-01</p>
                        <p>Check-out Date: 2023-11-07</p>
                        <span class="reservation-status confirmed">Confirmed</span>
                    </div>
                    
                </div>

               
                <div class="reservation-item">
                    <div class="reservation-info">
                        <h4>Mountain Retreat</h4>
                        <p>Location: Aspen, USA</p>
                        <p>Check-in Date: 2023-10-01</p>
                        <p>Check-out Date: 2023-10-05</p>
                        <span class="reservation-status cancelled">Cancelled</span>
                    </div>
                   
                </div>
            </section>
        </main>
    </div>
</body>
</html>
