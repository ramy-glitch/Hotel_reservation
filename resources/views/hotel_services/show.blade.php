<!DOCTYPE html>
<html>
<head>
    <title>Hotel Service Details</title>
</head>
<body>
    <h1>Hotel Service Details</h1>
    <p>Hotel ID: {{ $hotelService->hotel_id }}</p>
    <p>Service ID: {{ $hotelService->service_id }}</p>
    <a href="{{ route('hotel_services.index') }}">Back to list</a>
</body>
</html>