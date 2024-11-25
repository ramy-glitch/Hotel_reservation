<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Manager</title>
    <link rel="stylesheet" href="admin-style.css">
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
                <li><a href="admin-dashboard.html" class="nav-link">Users Management</a></li>
                <li><a href="hotels-manager-management.html" class="nav-link active">Hotel Manager Management</a></li>
                <li><a href="statistics.html" class="nav-link">Statistics</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="edit-form-container">
                <h3>Edit Manager</h3>
                <form action="hotels-manager-management.html" method="POST">
                    <label for="manager-name">Manager Name:</label>
                    <input type="text" id="manager-name" name="manager-name" value="Jane Doe">

                    <label for="manager-email">Email:</label>
                    <input type="email" id="manager-email" name="manager-email" value="jane.doe@example.com">

                    <label for="hotel-assigned">Hotel Assigned:</label>
                    <input type="text" id="hotel-assigned" name="hotel-assigned" value="Ocean View">

                    <div class="buttons">
                        <button type="submit" class="save-btn">Save Changes</button>
                        <a href="hotels manager-management.html" class="cancel-btn">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
