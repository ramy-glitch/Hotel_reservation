<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Manager Management</title>
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
        <h2 class="sidebar-logo">Dashboard</h2>
            <ul class="sidebar-menu">
                <li><a href="{{route('admins.index')}}" class="nav-link">Account Info</a></li>
                <li><a href="{{route('admin.statistics')}}" class="nav-link">Statistics</a></li>
                <li><a href="{{route('managers.list')}}" class="nav-link active">Hotels Manager Management</a></li>
                <li><a href="#" class="nav-link">Users Management</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <section class="section active">
                <h3>Hotel Manager Management</h3>
                
                <!-- Search Bar -->
                <div class="search-container">
                    <input type="text" placeholder="Search by manager name or ID" class="search-bar">
                    <button class="search-button">Search</button>
                   <a href="Add Manager.html"><button class="add-manager-button">Add Manager</button></a> 
                </div>

                <!-- Managers Table -->
                <table>
                    <thead>
                        <tr>
                            <th>Manager ID</th>
                            <th>Manager Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($managers as $manager)
                            <tr>
                                <td>{{ $manager->id }}</td>
                                <td>{{ $manager->username }}</td>
                                <td>{{ $manager->email }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('manager.edit', $manager->id) }}">
                                            <button class="edit-btn">Edit</button>
                                        </a>
                                        <a href="{{ route('manager.delete', $manager->id) }}">
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
</body>
</html>
