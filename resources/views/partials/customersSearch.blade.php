
@foreach($customers2 as $customer)
    <tr>
        <td>{{ $customer->id }}</td>
        <td>{{ $customer->username }}</td>
        <td>{{ $customer->birth_date }}</td>
        <td>{{ $customer->email }}</td>
        <td>
            <div class="action-buttons">
                <a href="{{ route('customer.edit', $customer->id) }}">
                    <button class="edit-btn">Edit</button>
                </a>
                <a href="{{ route('customer.delete', $customer->id) }}">
                    <button class="delete-btn">Delete</button>
                </a>
            </div>
        </td>
    </tr>
@endforeach