<!DOCTYPE html>
<html lang="en" data-theme="fantasy">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- carga y vincula archivos css y js -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- reserva espacio para contenido de vistas hijas -->
    @yield('content')
</body>
</html>