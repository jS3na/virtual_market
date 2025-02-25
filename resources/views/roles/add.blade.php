<x-main_layout pageTitle="Add Role">

    <form action="{{ route('roles.add.post') }}" method="post">

        @csrf

        <label for="name">
            <input type="text" name="name" placeholder="Name">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>
        <label for="description">
            <input type="text" name="description" placeholder="Description">
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>
        
        <button type="submit">Add</button>
    </form>

</x-main_layout>