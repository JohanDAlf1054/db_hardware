<table class="table table-striped table-hover" style="justify-content: center">
    <thead class="table-dark">
        <tr style="text-align: center">
            <th>Categoria </th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Referencia Fabrica</th>
            <th>Clasificación Tributaria</th>
            <th>Unidades</th>
            <th>Stock</th>
            <th>Estado</th>
            <th>Marca</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $producto)
            <tr style="text-align: center">
                <td>{{ $producto->categoryProduct->name}}</td>
                <td>{{ $producto->name_product }}</td>
                <td>{{ $producto->description_long }}</td>
                <td>{{ $producto->factory_reference }}</td>
                <td>{{ $producto->classification_tax }}</td>
                <td>{{ $producto->measurementUnit->code }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ $producto->status }}</td>
                <td>{{ $producto->brand->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>