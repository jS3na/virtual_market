<div>
    <ul>
        @foreach ($products as $product)
        <li>
            <strong>Name:</strong> {{ $product->name }} <br>
            <strong>Description:</strong> {{ $product->description }} <br>
            <strong>Price:</strong> {{ $product->price }} <br>
            <strong>Stock:</strong> {{ $product->stock }} <br>
            <strong>Category:</strong> {{ $product->category->name ?? 'No Category' }} <br>
            <a href="{{ route('products.edit', ['product_id' => $product->id]) }}">Edit</a>
            <form action="{{ route('products.delete', ['product_id' => $product->id]) }}" method="POST" onsubmit="return confirm('Are you sure that you want to delete?');">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
        <hr>
        @endforeach
    </ul>
</div>