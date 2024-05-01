@auth
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Persona</title>
    <link rel="stylesheet" href="{{ asset('css/products/all.css') }}" rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/estilosbarra.css') }}" rel='stylesheet'>

</head>
<div class="bread_crumb">
    {{ Breadcrumbs::render('person.create') }}
</div>
<body>
        <form method="POST" action="{{ route('person.store') }}"  role="form" enctype="multipart/form-data">
            @csrf
            @include('person.form')
        </form>

</body>
</html>
@endauth
@guest
    @include('include.falta_sesion')
@endguest
