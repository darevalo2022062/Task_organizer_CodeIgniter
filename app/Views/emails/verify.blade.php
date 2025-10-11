<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Verifica tu correo electrónico</h1>
    <p>Hola {{ $name }},</p>
    <p>Por favor, haz clic en el siguiente enlace para verificar tu dirección de correo electrónico:</p>
    <a href="{{ $verifyUrl }}">Verificar correo electrónico</a>
</body>
</html>