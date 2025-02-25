<x-main_layout pageTitle="Edit Category">

    <form action="{{ route('categories.edit.post', ['category_id' => $category->id]) }}" method="post">

        @csrf
        @method('PUT')

        <label for="name">
            <input type="text" name="name" placeholder="Name" value="{{ $category->name }}">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>

        <button type="submit">Edit</button>
    </form>

</x-main_layout>