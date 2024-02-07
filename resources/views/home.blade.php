<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    @auth
    <p>Welcome, {{ auth()->user()->name }}</p>
    <p><a href="/cart">Cart</a></p>
    <div>
        <h2>Products</h2>
        <form action="/createProduct" method="POST">
            @csrf
            <input type="text" name="product_name" placeholder="Product Name">
            <p><textarea type="text" name="product_desc" placeholder="Product Description"></textarea></p>
            <p><input type="number" name="product_price" placeholder="Product Price (RM)"></p>
            <p><input type="number" name="product_quantity" placeholder="Product Quantity"></p>
            <p><button>Create Product</button></p>
        </form>
    </div>
    <div>
        <h2>Products List</h2>
        <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }
</style>

<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Product Price</th>
            <th>Product Quantity</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->product_desc }}</td>
            <td>RM{{ $product->product_price }}</td>
            <td>{{ $product->product_quantity }}</td>
            <td>
                <form action="/addToCart" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    <input type="number" name="cart_quantity" placeholder="Quantity" value="1" min="1" max="{{ $product->product_quantity }}">
                    <button>Add to Cart</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    </div>
    <p></p>
    <form action="/logout" method="POST">
        @csrf
        <button>Log Out</button>
    </form>
    @else
    <p>Not logged in</p>
    @endauth
    
    @if(session()->has('success_message'))
    <script>
        alert('{{ session('success_message') }}');
    </script>
    @endif

</body>
</html>