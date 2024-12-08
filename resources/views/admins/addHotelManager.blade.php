<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Manager</title>
    <link rel="stylesheet" href="admin-style.css">
    <style>
        /* Form Styling */
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h3 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-actions {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
        }

        .save-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .save-btn:hover {
            background-color: #45a049;
        }

        .cancel-btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .cancel-btn:hover {
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
                <li><a href="{{route('managers.list')}}" class="nav-link ">Hotels Manager Management</a></li>
                <li><a href="{{route('customers.list')}}" class="nav-link active">Users Management</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="form-container">
                <h3>Add Manager</h3>
                <form action="save-manager.php" method="POST">
                    <div class="form-group">
                        <label for="manager-name">Manager Name:</label>
                        <input type="text" id="manager-name" name="manager-name" placeholder="Enter manager name" required>
                    </div>

                    <div class="form-group">
                        <label for="manager-email">Email:</label>
                        <input type="email" id="manager-email" name="manager-email" placeholder="Enter manager email" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="save-btn">Save</button>
                        <a href="{{ route('managers.list') }}" class="cancel-btn">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
