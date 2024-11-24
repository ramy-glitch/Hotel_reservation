<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics</title>
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2 class="sidebar-logo">Dashboard</h2>
            <ul class="sidebar-menu">
                <li><a href="{{route('admins.index')}}" class="nav-link active">Account Info</a></li>
                <li><a href="{{route('admin.statistics')}}" class="nav-link">Statistics</a></li>
                <li><a href="#" class="nav-link">Hotels Manager Management</a></li>
                <li><a href="#" class="nav-link">Users Management</a></li>
            </ul>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <section class="section active">
                <h3>Statistics</h3>
               
                <div class="stats-grid">
                    <div class="stat-item">
                        <h4>Total Users</h4>
                        <p>{{ $customers }}</p>
                    </div>
                    <div class="stat-item">
                        <h4>Total Hotels Managers</h4>
                        <p>{{ $hotelManagers }}</p>
                    </div>
                    <div class="stat-item">
                        <h4>Total Hotels</h4>
                        <p>{{ $hotels }}</p>
                    </div>
                    <div class="stat-item">
                        <h4>Total Reservations</h4>
                        <p>{{ $reservations }}</p>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
