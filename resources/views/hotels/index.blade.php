<!DOCTYPE html>
<html>
<head>
    <title>Hotels</title>
</head>
<body>
    <h1>Hotels</h1>
    <a href="{{ route('hotels.create') }}">Create Hotel</a>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif
    <ul>
        @foreach ($hotels as $hotel)
            <li>
                <a href="{{ route('hotels.show', $hotel->id) }}">{{ $hotel->hotelname }}</a>
                <a href="{{ route('hotels.edit', $hotel->id) }}">Edit</a>
                <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>