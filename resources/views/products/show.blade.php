<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
</head>
<body>
    <h1>{{ $product->name }}</h1>
    <p>Price: ${{ number_format($product->price, 2) }}</p>
</body>
</html>