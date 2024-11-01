<!DOCTYPE html>
<html>
<head>
    <title>Top Up Successful</title>
</head>
<body>
    <h1>Hello {{ $user->name }},</h1>
    <p>Your account has been successfully topped up with {{ $sePayWebhookData->amount }}.</p>
    <p>Thank you for using SePay!</p>
</body>
</html>
