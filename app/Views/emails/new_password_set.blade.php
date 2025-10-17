<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>NUEVA CONTRASEÑA</h1>
    <p>Hola {{ $name }},</p>
    <p>{{ lang('App.auth.email.new_password_set') }}</p>
    <p><strong>{{ $newPassword }}</strong></p>
</body>
</html>