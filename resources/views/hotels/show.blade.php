<!DOCTYPE html>
<html>
<head>
    <title>Hotel Details</title>
</head>
<body>
    <h1>{{ $hotel->hotelname }}</h1>
    <p>Location: {{ $hotel->location }}</p>
    <p>Child Age Limit: {{ $hotel->child_age_limit }}</p>
    <p>Manager ID: {{ $hotel->manager_id }}</p>
    <a href="{{ route('hotels.index') }}">Back to list</a>
</body>
</html>