<!DOCTYPE html>
<html>
<head>
    <title>Admin Details</title>
</head>
<body>
    <h1>{{ $admin->username }}</h1>
    <p>Email: {{ $admin->email }}</p>
    <a href="{{ route('admins.index') }}">Back to list</a>
</body>
</html>