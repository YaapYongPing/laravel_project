<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    @auth
    <p>Welcome, {{ auth()->user()->name }}</p>
    <div>
        <h2>Cart List</h2>
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
    @if($carts->isEmpty())
        <p>Your cart is empty</p>
    @else
    <table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Product Price</th>
            <th>Product Quantity</th>
            <th>Total Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($carts as $cart)
        <tr>
            <td>{{ $cart->product->product_name }}</td>
            <td>{{ $cart->product->product_desc }}</td>
            <td>RM{{ $cart->product->product_price }}</td>
            <td>{{ $cart->cart_quantity }}</td>
            <td>RM{{ $cart->product->product_price * $cart->cart_quantity }}</td>
            <td>
                <form action="/modifyQuantity" method="POST">
                    @csrf
                    <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                    <input type="hidden" name="product_id" value="{{ $cart->product_id }}">
                    <button>-</button>
                </form>
                <form action="/deleteItem" method="POST">
                    @csrf
                    <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                    <input type="hidden" name="product_id" value="{{ $cart->product_id }}">
                    <button>Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
    @endif
    </div>
    
    <p><a href="/home">Back</a></p>
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