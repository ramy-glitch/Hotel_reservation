<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Manager</title>
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <style>
        /* Center the content within the main section */
        .edit-form-container {
            margin: 20px auto;
            max-width: 800px;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .edit-form-container h3 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 20px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        .edit-form-container label {
            display: block;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
            color: #555;
        }

        .edit-form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .edit-form-container .buttons {
            display: flex;
            justify-content: flex-start;
            gap: 15px;
        }

        .edit-form-container .save-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
        }

        .edit-form-container .save-btn:hover {
            background-color: #218838;
        }

        .edit-form-container .cancel-btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
        }

        .edit-form-container .cancel-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2 class="sidebar-logo">Admin Dashboard</h2>
            <ul class="sidebar-menu">
                <li><a href="{{route('admins.index')}}" class="nav-link">Account Info</a></li>
                <li><a href="{{route('admin.statistics')}}" class="nav-link">Statistics</a></li>
                <li><a href="{{route('managers.list')}}" class="nav-link active">Hotels Manager Management</a></li>
                <li><a href="{{route('customers.list')}}" class="nav-link">Users Management</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="edit-form-container">
                <h3>Edit Manager</h3>

            <form action="{{ route('manager.update', $manager->id) }}" method="POST">
            @csrf

            <label for="manager-name">Manager Name:</label>
            <input type="text" id="manager-name" name="username" value="{{ $manager->username }}">

            <label for="manager-email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $manager->email }}">

            <div class="buttons">
                <button type="submit" class="save-btn">Save Changes</button>
                <a href="{{ route('managers.list') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
            </div>
        </main>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
