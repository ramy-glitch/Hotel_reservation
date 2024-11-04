<!DOCTYPE html>
<html>
<head>
    <title>Create Hotel Service</title>
</head>
<body>
    <h1>Create Hotel Service</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('hotel_services.store') }}" method="POST">
        @csrf
        <div>
            <label for="hotel_id">Hotel ID:</label>
            <input type="number" id="hotel_id" name="hotel_id" value="{{ old('hotel_id') }}">
        </div>
        <div>
            <label for="service_id">Service ID:</label>
            <input type="number" id="service_id" name="service_id" value="{{ old('service_id') }}">
        </div>
        <button type="submit">Create</button>
    </form>
    <a href="{{ route('hotel_services.index') }}">Back to list</a>
</body>
</html>