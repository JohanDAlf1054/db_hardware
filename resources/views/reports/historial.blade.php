@auth
@include('include.barra', ['modo' => 'Historial De Movimientos'])
<!DOCTYPE html>
<br>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
<link href="css/estilos_notificacion.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap5.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
</head>
<div class="container-fluid">
    
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-default">
                <div class="card-header" style="display: flex">
                    <button type="button" class="btn btn-light">
                        <a href="{{route('index_informes')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                        </a>
                    </button>
                    <h2 id="card_title">
                        {{ __('Informe Historial de Precios') }}
                    </h2>
                </div>
                {{-- {{ route('buscar.historial') }} ruta no definida --}}
                <form method="POST" action="{{ route('buscar.historial') }}">
                    @csrf
                <div class="card-body">
                    <div class="row border border-light p-2 mb-3 d-flex align-items-start">
                        <div class="col-12 col-md-6">
                            <div class="form-group d-flex align-items-center">
                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                    <label for="subcategoria" class="form-label">SubCategoria Del Producto</label>
                                    <select name="subcategoria" id="subcategoria" class="selectpicker form-control" data-live-search="true" style="text-align-last:center;">
                                        <option value="" selected disabled>Seleccione una Subcategoria</option>

                                        @foreach($subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center mt-3">
                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                    <label for="categoria" class="form-label">Categoria De Productos</label>
                                    <select name="categoria" id="categoria" class="selectpicker form-control" data-live-search="true" style="text-align-last:center;">
                                        <option value="" selected disabled>Seleccione una categoría</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                            <div class="form-group d-flex align-items-center mt-2">
                                <div class="d-flex flex-column flex-grow-1 mr-2 mb-3">
                                    <label for="producto" class="form-label">Producto</label>
                                    <select name="producto" id="producto" class="selectpicker form-control ml-2" data-live-search="true" style="text-align-last:center;">
                                        <option value="" selected disabled>Seleccione un Producto</option>

                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name_product }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                                <span id="buscar" class="mx-3"></span> 
                                <a href="/limpiar" class="btn btn-secondary">Limpiar</a>
                            </div>
                            
                            </div>
                            
                            <div class="col-12 col-md-6">
                                <div class="form-group d-flex align-items-center">
                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                        <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                                        <input name="fecha_inicio" id="fecha_inicio" type="date" class="form-control" style="text-align-last:center;" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center mt-3">
                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                        <label for="fecha_cierre" class="form-label">Fecha de cierre</label>
                                        <input name="fecha_cierre" id="fecha_cierre" type="date" class="form-control" style="text-align-last:center;" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                
                                <div class="form-group d-flex align-items-center mt-2">
                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                        <label for="estado" class="form-label">Estado</label>
                                        <select name="estado" id="estado" class="selectpicker form-control ml-2" data-live-search="true" style="text-align-last:center;">
                                            <option value="" selected disabled>Seleccione un Estado</option>
                                            @foreach($estados as $estado)
                                                <option value="{{ $estado == 'Activo' ? 1 : 0 }}">{{ $estado }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                    </div>
                </form>
                        <div class="table_container">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="justify-content: center; width: 100%;" id="datatable">
                                    <thead class="table-dark">
                                        <tr style="text-align: center">
                                            <th>Nombre Del Producto</th>
                                            <th>Referencia De Fabrica</th>
                                            <th>Cantidad Inicial</th>
                                            <th>Cantidad Entrada</th>
                                            <th>Fecha Inicial </th>
                                            <th>Fecha Final</th>
                                            <th>Fecha De La Factura</th>
                                            <th>Cantidad De Salida</th>
                                            <th>Saldo De Cantidades</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $detallesCompras = \App\Models\DetailPurchase::orderBy('created_at')->get()->groupBy('products_id');
                                    @endphp
                                    <tbody>
                                        
                                        @if ($ventas->isEmpty() && !$request->isMethod('post'))
                                            <tr>
                                                <td colspan="9" style="text-align: center">Por favor, busca un movimiento.</td>
                                            </tr>
                                        @elseif ($ventas->isEmpty() && $request->isMethod('post'))
                                            <tr>
                                                <td colspan="9" style="text-align: center">Actualmente, ningún dato coincide con lo que acabas de buscar. Intenta otra búsqueda.</td>
                                            </tr>
                                        @else
                                            @foreach ($ventas as $venta)
                                                @foreach ($venta->productos as $producto)
                                                    @if (isset($detallesCompras[$producto->id]))
                                                        @php
                                                            $detalleCompra = $detallesCompras[$producto->id]->shift();
                                                            $fechaInicial = $producto->created_at; 
                                                            $fechaFinal = $venta->created_at; 
                                                            $fechaFactura = $detalleCompra ? $detalleCompra->created_at : null; 
                                                            $cantidadIngresada = $detalleCompra ? $detalleCompra->quantity_units : 0;
                                                        @endphp
                                                        <tr>
                                                            <td style="text-align: center">{{ $producto->name_product }}</td>
                                                            <td style="text-align: center">{{ $producto->factory_reference }}</td>
                                                            <td style="text-align: center">0</td>
                                                            <td style="text-align: center">{{ $cantidadIngresada }}</td>
                                                            <td style="text-align: center">{{ $fechaInicial }}</td> 
                                                            <td style="text-align: center">{{ $fechaFinal }}</td> 
                                                            <td style="text-align: center">{{ $fechaFactura }}</td> 
                                                            <td style="text-align: center">{{ $producto->pivot->amount }}</td> 
                                                            <td style="text-align: center">{{ $producto->stock }}</td> 
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                </tbody>
                            </table>        
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
<script>
  var table = $('#datatable').DataTable({
    responsive: true,
    autoWidth: false,  
    searching: false,
    language: {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros por página",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla intente filtrar ",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "sPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    },
    columnDefs: [{
        targets: '_all',
        defaultContent: 'N/A' 
    }],
    data: @json($datos),
    columns: [
        { data: 'nombre_del_producto' },
        { data: 'referencia_de_fabrica' },
        { data: 'cantidad_inicial' },
        { data: 'cantidad_entrada' },
        { data: 'fecha_inicial' },
        { data: 'fecha_final' },
        { data: 'fecha_de_la_factura' },
        { data: 'cantidad_de_salida' },
        { data: 'saldo_de_cantidades' }
    ]
});
</script>
<style>
    #datatable tbody td {
        text-align: center;
    }
</style>
</html>
@endauth
@guest
    @include('include.falta_sesion')
@endguest