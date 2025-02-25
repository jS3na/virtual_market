<div>
    <ul>
        <a href="{{ route('user.change_password') }}">Change Password</a>
        @foreach ($users as $user)
        <li>
            <strong>Name:</strong> {{ $user->name }} <br>
            <strong>Email:</strong> {{ $user->email }} <br>
            <strong>Role:</strong> {{ $user->role->name }} <br>
            <a href="{{ route('users.edit', ['user_id' => $user->id]) }}">Edit</a>
            <form action="{{ route('users.delete', ['user_id' => $user->id]) }}" method="POST" onsubmit="return confirm('Are you sure that you want to delete?');">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
        <hr>
        @endforeach
    </ul>
</div>