<x-main_layout pageTitle="Edit Role">

    <form action="{{ route('roles.edit.post', ['role_id' => $role->id]) }}" method="post">

        @csrf
        @method('PUT')

        <label for="name">
            <input type="text" name="name" placeholder="Name" value="{{ $role->name }}">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>
        <label for="description">
            <input type="text" name="description" placeholder="Description" value="{{ $role->description }}">
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>

        @foreach ($permissions as $permission)
        <label for="{{ $permission->id }}">
        <input type="checkbox" name="{{ $permission->id }}" {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>

            <p>{{ $permission->name }}</p>

            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>
        @endforeach


        <button type="submit">Edit</button>
    </form>

</x-main_layout>