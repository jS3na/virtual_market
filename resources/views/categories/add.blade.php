<x-main_layout pageTitle="Add Category">

    <form action="{{ route('categories.add.post') }}" method="post">

        @csrf

        <label for="name">
            <input type="text" name="name" placeholder="Name">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>

        <button type="submit">Add</button>
    </form>

</x-main_layout>