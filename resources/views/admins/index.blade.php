<!DOCTYPE html>
<html>
<head>
    <title>Admins</title>
</head>
<body>
    <h1>Admins</h1>
    <a href="{{ route('admins.create') }}">Create Admin</a>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <!-- Logout Button -->
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <ul>
        @foreach ($admins as $admin)
            <li>
                <a href="{{ route('admins.show', $admin->id) }}">{{ $admin->username }}</a>
                <a href="{{ route('admins.edit', $admin->id) }}">Edit</a>
                <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>