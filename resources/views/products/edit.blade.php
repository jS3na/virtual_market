<x-main_layout pageTitle="Edit Product">

    <form action="{{ route('products.edit.post', ['product_id' => $product->id]) }}" method="post">

        @csrf
        @method('PUT')

        <label for="name">
            <input type="text" name="name" placeholder="Name" value="{{ $product->name }}">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>
        <label for="description">
            <input type="text" name="description" placeholder="description" value="{{ $product->description }}">
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>
        <label for="price">
            <input type="number" name="price" step="0.01" min="0" placeholder="price" value="{{ $product->price }}">
            @error('price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>
        <label for="stock">
            <input type="number" name="stock" min="0" placeholder="stock" value="{{ $product->stock }}">
            @error('stock')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>

        <label for="category_id">
            <select name="category_id" value="{{ $product->category_id }}">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>

        <button type="submit">Edit</button>
    </form>

</x-main_layout>