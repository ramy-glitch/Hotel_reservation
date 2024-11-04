<!DOCTYPE html>
<html>
<head>
    <title>Hotel Managers</title>
</head>
<body>
    <h1>Hotel Managers</h1>
    <a href="{{ route('hotel_managers.create') }}">Create Hotel Manager</a>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif
    <ul>
        @foreach ($hotelManagers as $hotelManager)
            <li>
                <a href="{{ route('hotel_managers.show', $hotelManager->id) }}">{{ $hotelManager->username }}</a>
                <a href="{{ route('hotel_managers.edit', $hotelManager->id) }}">Edit</a>
                <form action="{{ route('hotel_managers.destroy', $hotelManager->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>