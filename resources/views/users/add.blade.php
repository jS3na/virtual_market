<x-main_layout pageTitle="Add User">

    <form action="{{ route('users.add.post') }}" method="post">

        @csrf

        <label for="name">
            <input type="text" name="name" placeholder="Name">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>
        <label for="email">
            <input type="text" name="email" placeholder="Email">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>

        <label for="role_id">
            <select name="role_id">
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>

        <button type="submit">Add</button>
    </form>

</x-main_layout>