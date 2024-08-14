<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Your order has been queued</h1>

<p>User ID: {{ $order->userId }}</p>
<pre>
    @json($order->products, JSON_PRETTY_PRINT)
</pre>
</body>
</html>
