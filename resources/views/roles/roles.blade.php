<x-main_layout pageTitle="Roles">

    <div>
        <ul>
            @foreach ($roles as $role)
            <li>
                <strong>Name:</strong> {{ $role->name }} <br>
                <strong>Description:</strong> {{ $role->description }} <br>
                <a href="{{ route('roles.edit', ['role_id' => $role->id]) }}">Edit</a>
                <form action="{{ route('roles.delete', ['role_id' => $role->id]) }}" method="POST" onsubmit="return confirm('Are you sure that you want to delete?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
            <hr>
            @endforeach
        </ul>
    </div>

</x-main_layout>|