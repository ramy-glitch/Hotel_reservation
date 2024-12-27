<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Hotel</title>
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
            <section id="hotelform" class="section active">
                <h3>Add New Hotel</h3>
                <form id="add-hotel-room-form">
                    <div class="form-group">
                        <label for="hotel-name">Hotel Name:</label>
                        <input type="text" id="hotel-name" name="hotel-name" required>
                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" required>
                    </div>
                    <div calss ="form-group">
                       <button type="submit" class="btn-submit">Add Hotel</button> 
                    </div>
                    
                </form>
                <h3> Room types</h3>
                <form>
                    <div class="form-group">
                        <label for="room-type">Room Type:</label><br>
                        <select id="room-type" name="room-type" value="" required>
                            <option value="single">Single Room</option>
                            <option value="double">Double Room</option>
                            <option value="suite">Suite</option>
                            <option value="family">Family room</option>
                            <option value="deluxe">Deluxe Room</option>
                            <option value="studio">Studio</option>
                        </select>
                        <br>
                        <br>
                        <label for="rooms">Number of Rooms:</label>
                        <input type="number" id="rooms" name="rooms" required>
                        <br><br>
                        <label for="room-price">Room Price:</label>
                        <input type="number" id="room-price" name="room-price" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-edit">Add room type</button>
                    </div>
                </form>
            </section>
            <section id="hotels" class="section active">
                <table class="responsive-table">
                    <thead>
                        <tr>
                            <th>Hotel Name</th>
                            <th>Location</th>
                            <th>Stars</th>
                            <th>Total Rooms</th>
                            <th>Room Type</th>
                            <th>Available</th>>
                            <th>Room Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Grand Hotel</td>
                            <td>Paris, France</td>
                            <td>5</td>
                            <td>150</td>
                            <td>Single Room</td>
                            <td>25</td>
                            <td>25.000da</td>
                            <td>
                                <button class="btn-edit">Edit</button>
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