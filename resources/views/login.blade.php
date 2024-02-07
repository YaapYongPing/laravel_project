<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel</title>
</head>
<body>
    <div>
    <h2>Login</h2>
    <form action="/login" method="POST">
        @csrf
        <input type="email" name="loginemail" placeholder="Email"><br><br>
        <input type="password" name="loginpassword" placeholder="Password"><br><br>
        <input type="submit" value="Log In">
    </form>
    <a href="/register">Register</a>
</div>
</body>
</html>