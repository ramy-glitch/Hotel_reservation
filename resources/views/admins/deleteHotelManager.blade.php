<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Hotel Manager</title>
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <style>
        .delete-form-container {
            margin: 20px auto;
            max-width: 800px;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .delete-form-container h3 {
            font-size: 1.5rem;
            color: #dc3545;
            margin-bottom: 20px;
            border-bottom: 2px solid #dc3545;
            padding-bottom: 10px;
        }

        .delete-form-container p {
            font-size: 1rem;
            color: #333;
            margin-bottom: 15px;
        }

        .delete-form-container .info {
            font-weight: bold;
            color: #555;
        }

        .delete-form-container .buttons {
            display: flex;
            justify-content: flex-start;
            gap: 15px;
        }

        .delete-form-container .confirm-btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
        }

        .delete-form-container .confirm-btn:hover {
            background-color: #c82333;
        }

        .delete-form-container .cancel-btn {
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
        }

        .delete-form-container .cancel-btn:hover {
            background-color: #5a6268;
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
            <div class="delete-form-container">
                <h3>Delete Hotel Manager</h3>
                <p>Are you sure you want to delete this Hotel Manager?</p>
                <p><span class="info">Manager Name:</span> {{ $manager->username }}</p>
                <p><span class="info">Email:</span> {{ $manager->email }}</p>
                <div class="buttons">
                <form action="{{ route('manager.delete', ['id' => $manager->id]) }}" method="GET" style="display: inline;">
                    @csrf
                    <button type="submit" class="confirm-btn">Confirm Delete</button>
                </form>
                    <a href="{{ route('managers.list') }}" class="cancel-btn">Cancel</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>