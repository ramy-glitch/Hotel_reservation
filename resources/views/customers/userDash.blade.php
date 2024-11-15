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
            <section id="account-info" class="section active">
                <h3>Account Information</h3>
                <div class="profile-picture">
                    <img src="{{ asset('images/profile.jpg') }}" alt="Profile Picture">
                    <button>Upload New Picture</button>
                </div>
                <div class="personal-info">
                    <h4>Personal Information</h4>
                    <label>Full Name</label>
                    <input type="text" value="{{ $customer->username }}" disabled>

                    <label>Email Address</label>
                    <input type="email" value="{{ $customer->email }}" disabled>

                    <label>Date of Birth</label>
                    <input type="text" value="{{ $customer->birth_date }}" disabled>
                </div>
                <div class="security-settings">
                    <h4>Security Settings</h4>
                    <button>Change Password</button>
                </div>
                <div class="notification-settings">
                    <h4>Contact Preferences</h4>
                    <label>Email Notifications</label>
                    <input type="checkbox" checked>
                    <label>SMS Notifications</label>
                    <input type="checkbox">
                </div>
                <div class="address-info">
                    <h4>Address Information</h4>
                    <label>Primary Address</label>
                    <input type="text" value="123 Main St, City, Country" disabled>
                </div>
                <div class="account-actions">
                        <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="delete-account" type="submit">Logout</button>
                    </form>
                    <button class="delete-account">Delete Account</button>
                </div>
            </section>

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

            <section id="reservations-history" class="section">
                <h3>Reservations History</h3>
                <p>Review your past reservations.</p>
            </section>

            <section id="notifications" class="section">
                <h3>Notifications</h3>
                <p>View your recent notifications and updates.</p>
            </section>
        </main>
    </div>



    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>