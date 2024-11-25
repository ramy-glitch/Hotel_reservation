<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Manager Management</title>
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
        <h2 class="sidebar-logo">Dashboard</h2>
            <ul class="sidebar-menu">
                <li><a href="{{route('admins.index')}}" class="nav-link">Account Info</a></li>
                <li><a href="{{route('admin.statistics')}}" class="nav-link">Statistics</a></li>
                <li><a href="{{route('managers.list')}}" class="nav-link ">Hotels Manager Management</a></li>
                <li><a href="{{route('customers.list')}}" class="nav-link active">Users Management</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <section class="section active">
                <h3>Users Management</h3>
                
                <!-- Search Bar -->
                <div class="search-container">
                    <form id="search-form">
                        <input type="text" name="search" placeholder="Search customer " class="search-bar">
                        <button type="submit" class="search-button">Search</button>
                    </form>
                </div>

                <!-- customers Table -->
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Birth date</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id = "customer-grid">
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->username }}</td>
                                <td>{{ $customer->birth_date }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('customer.edit', $customer->id) }}">
                                            <button class="edit-btn">Edit</button>
                                        </a>
                                        <a href="{{ route('customer.delete', $customer->id) }}">
                                            <button class="delete-btn">Delete</button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <script>
$(document).ready(function() {
    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        const query = $('input[name="search"]').val();

        $.ajax({
            url: `{{ route('customer.search') }}?search=${query}`,
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
            success: function(response) {
                const customersContainer = $('#customer-grid');
                customersContainer.empty();

                if (response.html.trim() === '') {
                    customersContainer.html('<p>No users found.</p>');
                } else {
                    customersContainer.html(response.html);
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    });
});
</script>


</body>
</html>
