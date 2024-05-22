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
            <th>Id</th>
            <th>Fecha</th>
            <th>Nº de factura</th>
            <th>Vendedor</th>
            <th>Forma de pago</th>
            <th>Total Bruto</th>
            <th>Total Impuesto</th>
            <th>Total Neto</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ventas as $sale)
        <tr style="text-align: center">
            <td>{{$sale->id}}</td>
            <td>{{$sale->dates}}</td>
            <td>{{$sale->bill_numbers}}</td>
            <td>{{$sale->sellers}}</td>
            <td>{{$sale->payments_methods}}</td>
            <td>{{$sale->gross_totals}}</td>
            <td>{{$sale->taxes_total}}</td>
            <td>{{$sale->net_total}}</td>
            <td>
                @if($sale->status == True)
                <p class="badge rounded-pill bg-success" style="font-size: 15px">Activo</p>
                @else
                <p class="badge rounded-pill bg-danger" style="font-size: 15px">Inactivo</p>
                @endif
            </td>
        </tr>
        @endforeach
</body>
</html>