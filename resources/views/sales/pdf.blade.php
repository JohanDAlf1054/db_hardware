<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF - Informe de ventas</title>
    <link rel="stylesheet" href="{{public_path('css/pdf.css')}}" type="text/css">
</head>
<body>
    <div class="encabezado">
        <div class="Title_Informe">
            <h1 class="NombreInforme">Informe de ventas</h1>
        </div>
        <img src="{{ public_path('img/LogoBlanco_Ferreteria.png') }}" class="imgPDF">
        <h1 class="FerreteriaEx">Ferretería la Excelencia</h1>
        <p>NIT 9.524.275</p>
    </div>
<br>
<table>
    <thead >
        <tr>
            <th>Fecha</th>
            <th>Nº de factura</th>
            <th>Identificación</th>
            <th>Tipo de identificación</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Razon social</th>
            <th>Forma de pago</th>
            <th>Total bruto</th>
            <th>Total impuesto</th>
            <th>Total neto</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ventas as $sale)
        <tr style="text-align: center">
            <td>{{$sale->dates}}</td>
            <td>{{$sale->bill_numbers}}</td>
            <td>{{$sale->cliente->identification_number}}</td>
            <td>{{$sale->cliente->identification_type}}</td>
            <td>{{$sale->cliente->first_name}}</td>
            <td>{{$sale->cliente->surname}}</td>
            <td>{{$sale->cliente->company_name}}</td>
            <td>{{$sale->payments_methods}}</td>
            <td>{{$sale->gross_totals}}</td>
            <td>{{$sale->taxes_total}}</td>
            <td>{{$sale->net_total}}</td>
            {{--  Lo que se ha agregado  --}}

        </tr>
        @endforeach
</body>
</html>
