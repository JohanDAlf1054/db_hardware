<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Persona</title>
    <link rel="stylesheet" href="{{ asset('css/estilos_agregar_producto.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/estilosbarra.css') }}" type="text/css">

</head>
<body>
    {{--  Traer el formulario para registrar a la persona  --}}
        <form method="POST" action="{{ route('person.store') }}"  role="form" enctype="multipart/form-data">
            @csrf
            @include('person.form')
        </form>

</body>
</html>
