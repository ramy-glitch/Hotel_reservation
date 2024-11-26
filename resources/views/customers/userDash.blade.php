<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                <li><a href="{{ route('customer.dashboard') }}" class="nav-link active">Account Info</a></li>
                <li><a href="{{ route('hotels.index') }}" class="nav-link">Hotels</a></li>
                <li><a href="#reservations-history" class="nav-link">Reservations History</a></li>
                <li><a href="#notifications" class="nav-link">Notifications</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <!-- Account Info Section -->
            <section id="account-info" class="section active">
                <h3>Account Information</h3>

                <!-- Personal Info Form -->
                <div class="personal-info">
                    <h4>Personal Information</h4>
                    <form id="update-username-form">
                        <label for="username">User Name</label>
                        <input type="text" id="username" name="username" value="{{ $customer->username }}">

                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" value="{{ $customer->birth_date }}" >

                        <button type="submit" class="update-button">Update Information</button>
                    </form>
                </div>

                <!-- Security Settings Form -->
                <div class="security-settings">
                    <h4>Security Settings</h4>
                    <form id="change-password-form">
                        <label for="current-password">Current Password</label>
                        <input type="password" id="current-password" name="current-password" placeholder="Enter current password" required>

                        <label for="new-password">New Password</label>
                        <input type="password" id="new-password" name="new-password" placeholder="Enter new password" required>

                        <label for="confirm-password">Confirm New Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm new password" required>

                        <ul class="password-conditions">
                                    <li id="length" class="invalid">Au moins 8 caractères</li>
                                    <li id="uppercase" class="invalid">Au moins une majuscule</li>
                                    <li id="lowercase" class="invalid">Au moins une minuscule</li>
                                    <li id="number" class="invalid">Au moins un chiffre</li>
                                    <li id="match" class="invalid">Les mots de passe doivent correspondre</li>
                                </ul> 

                        <button type="submit" class="update-button">Change Password</button>
                    </form>

                    <script src="{{ asset('js/script.js') }}"></script>
                </div>

                <!-- Delete Account -->
                <div class="account-actions">
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="delete-account" type="submit">Logout</button>
                    </form>
                    
                    <form id="delete-account-form">
                        @csrf
                        @method('DELETE')
                        <button class="delete-account" type="submit">Delete Account</button>
                </div>
            </section>

            
    
    <script>
    // Update Username
    window.onload = function() {
        $('#update-username-form').submit(function(e) {
            e.preventDefault();
            var username = $('#username').val();
            var dob = $('#dob').val();
            $.ajax({
                url: "{{ route('customer.updateUsernameBirthday', ['id' => $customer->id]) }}",
                type: 'POST',
                data: {
                    username: username,
                    dob: dob,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.success);
                    } else {
                        alert('Error: ' + response.error);
                    }
                },
                error: function(response) {
                    if (response.responseJSON && response.responseJSON.errors) {
                        alert('Validation errors: ' + JSON.stringify(response.responseJSON.errors));
                    } else {
                        alert('Server error: ' + response.statusText);
                    }
                }
            });
        });

        // Change Password
        $('#change-password-form').submit(function(e) {
            e.preventDefault();
            var currentPassword = $('#current-password').val();
            var newPassword = $('#new-password').val();
            var confirmPassword = $('#confirm-password').val();
            $.ajax({
                url: "{{ route('customer.updatePassword', ['id' => $customer->id]) }}",
                type: 'POST',
                data: {
                    'current-password': currentPassword,
                    'new-password': newPassword,
                    'confirm-password': confirmPassword,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.success);
                    } else {
                        alert('Error: ' + response.error);
                    }
                },
                error: function(response) {
                    if (response.responseJSON && response.responseJSON.errors) {
                        alert('Validation errors: ' + JSON.stringify(response.responseJSON.errors));
                    } else {
                        alert('Server error: ' + response.statusText);
                    }
                }
            });
        });


        // Delete Account
        $('#delete-account-form').submit(function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete your account?')) {
                $.ajax({
                    url: "{{ route('customer.destroy', ['id' => $customer->id]) }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            window.location.href = "{{ route('welcome') }}";
                        } else {
                            alert('Error: ' + response.error);
                        }
                    },
                    error: function(response) {
                        if (response.responseJSON && response.responseJSON.errors) {
                            alert('Validation errors: ' + JSON.stringify(response.responseJSON.errors));
                        } else {
                            alert('Server error: ' + response.statusText);
                        }
                    }
                });
            }
        });
    };
</script>

    </body>
    </html>