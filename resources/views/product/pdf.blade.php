<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF - Informe de productos</title>
    <link rel="stylesheet" href="{{public_path('css/pdf.css')}}" type="text/css">
</head>
<body>
    <div class="encabezado">
        <div class="Title_Informe">
            <h1 class="NombreInforme">Informe de productos</h1>
        </div>
        <img src="{{ public_path('img/LogoBlanco_Ferreteria.png') }}" class="imgPDF">
        <h1 class="FerreteriaEx">Ferretería la Excelencia</h1>
        <p>NIT 9.524.275</p>
    </div>
<br>
<table>
    <thead>
        <tr>
            <th style="text-align: center">Categoría </th>
            <th style="text-align: center">Subcategoría</th>
            <th style="text-align: center">Nombre</th>
            <th style="text-align: center">Referencia Fabrica</th>
            <th style="text-align: center">Clasificación Tributaria</th>
            <th style="text-align: center">Precio de Compra</th>
            <th style="text-align: center">Precio de Venta</th>
            <th style="text-align: center">Marca</th>
            <th style="text-align: center">Unidad de Medida</th>
            <th style="text-align: center">Existencias</th>
            <th style="text-align: center">Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
            <tr >
                <td style="text-align: center">{{ $producto->categoryProduct->name}}</td>
                <td style="text-align: center">{{ $producto->subcategory_product}}</td>
                <td style="text-align: center">{{ $producto->name_product }}</td>
                <td style="text-align: center">{{ $producto->factory_reference }}</td>
                <td style="text-align: center">{{ $producto->classification_tax }}</td>
                <td style="text-align: center">{{ $producto->purchase_price }}</td>
                <td style="text-align: center">{{ $producto->selling_price }}</td>
                <td style="text-align: center">{{ $producto->brand->name }}</td>
                <td style="text-align: center">{{ $producto->measurementUnit->name }}</td>
                <td style="text-align: center">
                    @if ($producto->stock < 5)
                        <span class="badge rounded-pill bg-danger" style="font-size: 14px" tooltip="tooltip"
                        title="Pocas Existencias" >{{ $producto->stock }}</span>
                    @else
                        <span>{{ $producto->stock }}</span>
                    @endif
                </td>
                <td style="text-align: center">
                    @if ($producto->status == 1)
                        <p class="badge rounded-pill bg-success text-white" style="font-size: 15px">Activo</p>
                    @else
                        <p class="badge rounded-pill bg-danger"  style="font-size: 15px">Inactivo</p>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
