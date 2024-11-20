<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2 class="sidebar-logo">Dashboard</h2>
            <ul class="sidebar-menu">
                <li><a href="#account-info" class="nav-link active">Account Info</a></li>
                <li><a href="{{ route('hotels.index') }}" class="nav-link">Hotels</a></li>
                <li><a href="#reservations-history" class="nav-link">Reservations History</a></li>
                <li><a href="#notifications" class="nav-link">Notifications</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <!-- Account Info Section -->
            <section id="account-info" class="section active">
                <h3>Account Information</h3>

                <!-- Personal Info Form -->
                <div class="personal-info">
                    <h4>Personal Information</h4>
                    <form id="update-username-form">
                        <label for="username">User Name</label>
                        <input type="text" id="username" name="username" value="{{ $customer->username }}" required>

                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ $customer->email }}" required>

                        <label for="dob">Date of Birth</label>
                        <input type="text" id="dob" value="{{ $customer->birth_date }}" disabled>

                        <button type="submit" class="update-button">Update Information</button>
                    </form>
                </div>

                <!-- Security Settings Form -->
                <div class="security-settings">
                    <h4>Security Settings</h4>
                    <form id="change-password-form">
                        <label for="current-password">Current Password</label>
                        <input type="password" id="current-password" name="current-password" placeholder="Enter current password" required>

                        <label for="new-password">New Password</label>
                        <input type="password" id="new-password" name="new-password" placeholder="Enter new password" required>

                        <label for="confirm-password">Confirm New Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm new password" required>

                        <button type="submit" class="update-button">Change Password</button>
                    </form>
                </div>

                <!-- Delete Account -->
                <div class="account-actions">
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="delete-account" type="submit">Logout</button>
                    </form>
                    <button class="delete-account">Delete Account</button>
                </div>
            </section>

            <!-- Hotels Section -->
            <section id="hotels" class="section">
                <h3>Available Hotels</h3>
                <div class="filter-bar">
                    <input type="text" placeholder="Search hotels..." class="search-bar">
                    <select class="filter">
                        <option value="">Filter by Rating</option>
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                    </select>
                    <button class="filter-button">Apply Filter</button>
                </div>

                <div class="hotel-grid">
                    <div class="hotel-card">
                        <img src="{{ asset('images/hotel1.jpg') }}" alt="Hotel Image">
                        <div class="hotel-info">
                            <h4>Hotel Name</h4>
                            <p>Location: City, Country</p>
                            <p>Rating: ⭐⭐⭐⭐⭐</p>
                            <button class="details-button">View Details</button>
                        </div>
                    </div>

                    <div class="hotel-card">
                        <img src="{{ asset('images/hotel2.jpg') }}" alt="Hotel Image">
                        <div class="hotel-info">
                            <h4>Hotel Name</h4>
                            <p>Location: City, Country</p>
                            <p>Rating: ⭐⭐⭐⭐</p>
                            <button class="details-button">View Details</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Reservations History Section -->
            <section id="reservations-history" class="section">
                <h3>Reservations History</h3>
                <p>Review your past reservations.</p>
            </section>

            <!-- Notifications Section -->
            <section id="notifications" class="section">
                <h3>Notifications</h3>
                <p>View your recent notifications and updates.</p>
            </section>
        </main>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>