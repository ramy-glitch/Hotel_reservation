
@foreach($managers2 as $manager)
    <tr>
        <td>{{ $manager->id }}</td>
        <td>{{ $manager->username }}</td>
        <td>{{ $manager->email }}</td>
        <td>
            <div class="action-buttons">
                <a href="{{ route('manager.edit', $manager->id) }}">
                    <button class="edit-btn">Edit</button>
                </a>
                <a href="{{ route('manager.delete', $manager->id) }}">
                    <button class="delete-btn">Delete</button>
                </a>
            </div>
        </td>
    </tr>
@endforeach