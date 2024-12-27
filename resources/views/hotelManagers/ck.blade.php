<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotel Manager Dashboard</title>
        <link rel="stylesheet" href="{{ asset('css/hm.css') }}">
    </head>
    <body>
        <div class="dashboard-container">
            <!-- Sidebar -->
            <aside class="sidebar">
                <h2 class="sidebar-logo">Manager Dashboard</h2>
                <ul class="sidebar-menu">
                <li><a href="{{route('hotelManager.index')}}" class="nav-link ">Account Info</a></li>
                <li><a href="{{route('hotelManagers.hotels')}}" class="nav-link ">Hotels</a></li>
                <li><a href="{{route('cake')}}" class="nav-link active">Reservations</a></li>
                </ul>
            </aside>

            <main class="main-content">

                <section id="reservations" class="section active">
                    <h3>Recent Reservations</h3>
                    <div class="search-create">
                        <input type="text" placeholder="Search reservation...">
                        <button class="btn-create">Search</button>
                    </div>
                    <table class="responsive-table">
                        <thead>
                            <tr>
                                <th>Reservation ID</th>
                                <th>Check in</th>
                                <th>Check out</th>
                                <th>Customer ID</th>
                                <th>Room</th>
                                <th>Nbr adults</th>
                                <th>Nbr childen</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#001</td>
                                <td>27/7/2025</td>
                                <td>30/7/2025</td>
                                <td>#0012</td>
                                <td>404</td>
                                <td>2</td>
                                <td>2</td>
                                <td>
                                    <a href="ReservationForm.html"><button class="btn-edit">Edit</button></a>
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