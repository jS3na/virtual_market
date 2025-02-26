<x-main_layout pageTitle="Categories">

<div>
    <ul>
        @foreach ($categories as $category)
        <li>
            <strong>Name:</strong> {{ $category->name }} <br>
            <a href="{{ route('categories.edit', ['category_id' => $category->id]) }}">Edit</a>
            <form action="{{ route('categories.delete', ['category_id' => $category->id]) }}" method="POST" onsubmit="return confirm('Are you sure that you want to delete?');">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
        <hr>
        @endforeach
    </ul>
</div>

</x-main_layout>