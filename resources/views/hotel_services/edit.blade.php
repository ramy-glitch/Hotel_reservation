<!DOCTYPE html>
<html>
<head>
    <title>Edit Hotel Service</title>
</head>
<body>
    <h1>Edit Hotel Service</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('hotel_services.update', $hotelService->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="hotel_id">Hotel ID:</label>
            <input type="number" id="hotel_id" name="hotel_id" value="{{ old('hotel_id', $hotelService->hotel_id) }}">
        </div>
        <div>
            <label for="service_id">Service ID:</label>
            <input type="number" id="service_id" name="service_id" value="{{ old('service_id', $hotelService->service_id) }}">
        </div>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('hotel_services.index') }}">Back to list</a>
</body>
</html>