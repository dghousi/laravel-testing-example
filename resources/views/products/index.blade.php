<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>
    <h1>Products List</h1>
    <ul>
        @foreach($products as $product)
            <li>{{ $product->name }} - ${{ number_format($product->price, 2) }}</li>
        @endforeach
    </ul>
</body>
</html>