<x-main_layout pageTitle="Add User">

    <form action="{{ route('users.edit.post', ['user_id' => $user->id]) }}" method="post">

        @csrf
        @method('PUT')

        <label for="role_id">
            <select name="role_id">
                <option value="">No Role</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>

        <button type="submit">Edit</button>
    </form>

</x-main_layout>