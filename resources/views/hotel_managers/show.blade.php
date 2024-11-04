<!DOCTYPE html>
<html>
<head>
    <title>Hotel Manager Details</title>
</head>
<body>
    <h1>{{ $hotelManager->username }}</h1>
    <p>Email: {{ $hotelManager->email }}</p>
    <a href="{{ route('hotel_managers.index') }}">Back to list</a>
</body>
</html>