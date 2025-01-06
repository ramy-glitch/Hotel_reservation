<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yours Hotels</title>
    <link rel="stylesheet" href="{{ asset('css/hm.css') }}">
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <h2 class="sidebar-logo">Manager Dashboard</h2>
            <ul class="sidebar-menu">
            <li><a href="{{route('hotelManager.index')}}" class="nav-link ">Account Info</a></li>
                <li><a href="{{route('hotelManagers.hotels')}}" class="nav-link active">Hotels</a></li>
                <li><a href="{{route('cake')}}" class="nav-link">Reservations</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <section id="hotels" class="section active">
                <h3>Your Hotels</h3>
                
                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Search hotels..." aria-label="Search hotels">
                    <button class="search-button">Search</button>
                    <a href="{{route('hotelManagers.addHotel')}}"><button class="filter-button">Add Hotel</button></a>
                </div>

                <br>
                <div class="filter-bar">
                    <div class="filter-group">
                        <label for="rating-filter" class="filter-label">Filter by Rating:</label>
                        <select id="rating-filter" class="filter-select">
                            <option value="">Select Rating</option>
                            <option value="5">5 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="3">3 Stars</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="location-filter" class="filter-label">Filter by Location:</label>
                        <select id="location-filter" class="filter-select">
                            <option value="">Select Location</option>
                            <option value="city1">City 1</option>
                            <option value="city2">City 2</option>
                            <option value="city3">City 3</option>
                        </select>
                    </div>

                    <button class="filter-button">Apply Filter</button>
                    
                </div>
            

                <table class="responsive-table">
                    <thead>
                        <tr>
                            <th>Hotel Name</th>
                            <th>Location</th>
                            <th>child limit age</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hotels as $hotel)
                        <tr>
                            <td>{{ $hotel->hotelname }}</td>
                            <td>{{ $hotel->location }}</td>
                            <td>{{ $hotel->child_age_limit }}</td>
                            <td>
                                <a href="HotelForm.html"><button class="btn-edit">Edit</button></a>
                                <button class="btn-delete" onclick="showConfirmation()">Delete</button>

                                <div class="overlay" id="confirmationOverlay">
                                    <div class="confirmation-dialog">
                                        <h3>Are you sure?</h3>
                                        <p>Do you really want to delete this item?</p>
                                        <div class="dialog-buttons">
                                            <button class="btn-confirm" onclick="confirmAction()">Yes</button>
                                            <button class="btn-cancel" onclick="closeConfirmation()">No</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
<script>
    // Show the confirmation dialog
    function showConfirmation() {
        document.getElementById('confirmationOverlay').style.display = 'flex';
    }

    // Hide the confirmation dialog
    function closeConfirmation() {
        document.getElementById('confirmationOverlay').style.display = 'none';
    }

    // Perform the confirmed action
    function confirmAction() {
        alert('Item deleted successfully!');
        closeConfirmation();
    }
</script>

</html>