<!DOCTYPE html>
<html>
<head>
    <title>Customer Details</title>
</head>
<body>
    <h1>{{ $customer->username }}</h1>
    <p>Email: {{ $customer->email }}</p>
    <p>Birth Date: {{ $customer->birth_date }}</p>
    <a href="{{ route('customers.index') }}">Back to list</a>
</body>
</html>