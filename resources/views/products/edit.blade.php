<form method="POST" action="{{ route('products.update', $product->id) }}">
    @csrf
    @method('PATCH')
    <input type="text" name="name" value="{{ $product->name }}">
    <input type="number" name="price" value="{{ $product->price }}" step="0.01">
    <button type="submit">Update</button>
</form>