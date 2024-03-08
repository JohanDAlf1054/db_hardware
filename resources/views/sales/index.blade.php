@include('sales.barra')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos_agregar_producto.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/estilosbarra.css') }}" type="text/css">
    @livewireStyles
 
    <title>Ventas</title>
</head>
<body>
    
    @livewire('sales')

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>