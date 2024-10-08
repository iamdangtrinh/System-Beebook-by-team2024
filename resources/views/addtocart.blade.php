<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <form action={{ route('cart.store') }} method="post">
        @csrf
        <input type="text" value="2" name="id_product">
        <input type="text" value="200000" name="price">
        <input type="text" value="3" name="quantity">
        <button>Gửi</button>
    </form>


    {{ dd(session()->get('cart')) }}

</body>

</html>
