@auth
@include('include.barra',['modo'=>'Ventas'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">   
    <link rel="stylesheet" href="{{ asset('css/estilosbarra.css') }}" type="text/css">
    @stack('css')

    <title>Ventas</title>
</head>
<body>
<main
    @yield('content')
</main>

    @stack('js')
</body>
</html>

@endauth
@guest
    @include('include.falta_sesion')
@endguest
