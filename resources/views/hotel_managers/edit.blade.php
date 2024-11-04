<!DOCTYPE html>
<html>
<head>
    <title>Edit Hotel Manager</title>
</head>
<body>
    <h1>Edit Hotel Manager</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('hotel_managers.update', $hotelManager->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="{{ old('username', $hotelManager->username) }}">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $hotelManager->email) }}">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
        </div>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('hotel_managers.index') }}">Back to list</a>
</body>
</html>