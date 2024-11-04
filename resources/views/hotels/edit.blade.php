<!DOCTYPE html>
<html>
<head>
    <title>Edit Hotel</title>
</head>
<body>
    <h1>Edit Hotel</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('hotels.update', $hotel->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="hotelname">Hotel Name:</label>
            <input type="text" id="hotelname" name="hotelname" value="{{ old('hotelname', $hotel->hotelname) }}">
        </div>
        <div>
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" value="{{ old('location', $hotel->location) }}">
        </div>
        <div>
            <label for="child_age_limit">Child Age Limit:</label>
            <input type="number" id="child_age_limit" name="child_age_limit" value="{{ old('child_age_limit', $hotel->child_age_limit) }}">
        </div>
        <div>
            <label for="manager_id">Manager ID:</label>
            <input type="number" id="manager_id" name="manager_id" value="{{ old('manager_id', $hotel->manager_id) }}">
        </div>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('hotels.index') }}">Back to list</a>
</body>
</html>