<!DOCTYPE html>
<html>
<head>
    <title>Hotel Services</title>
</head>
<body>
    <h1>Hotel Services</h1>
    <a href="{{ route('hotel_services.create') }}">Create Hotel Service</a>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif
    <ul>
        @foreach ($hotelServices as $hotelService)
            <li>
                <a href="{{ route('hotel_services.show', $hotelService->id) }}">Hotel ID: {{ $hotelService->hotel_id }}, Service ID: {{ $hotelService->service_id }}</a>
                <a href="{{ route('hotel_services.edit', $hotelService->id) }}">Edit</a>
                <form action="{{ route('hotel_services.destroy', $hotelService->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>