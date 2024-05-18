@auth
@include('include.barra', ['modo' => 'Informe Historia de Precios Compras'])
<br>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
</head>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-default">
                <div class="card-header" style="display: flex">
                    <button type="button" class="btn btn-light">
                        <a href="{{route('products.index')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                        </a>
                    </button>
                    <h2 id="card_title">
                        {{ __('Informe Historial de Precios Compras') }}
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row border border-light p-2 mb-3 d-flex align-items-start">
                        <div class="col-12 col-md-6">
                            <form method="GET" action="{{ route('filtrarPurchase') }}">
                                <div class="form-group d-flex align-items-center">
                                    <div class="d-flex flex-column flex-grow-1 mr-2 mb-2">
                                        <label for="product_id" class="form-label @error('product_id') is-invalid @enderror" style="font-weight: bolder">Producto</label>
                                        <select id="product_id" name="product_id" class="selectpicker form-control ml-2" data-live-search="true" aria-placeholder="Seleccione el producto" style="text-align-last:center;">
                                            <option value="">Seleccione el producto</option>
                                            @foreach ($product as $item)
                                                <option value="{{ $item->id }}-{{ $item->categoryProduct->name }}-{{ ($item->status == 1) ? 'Activo' : 'Inactivo' }}">{{ $item->name_product }}</option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center">
                                    <div class=" col-md-6 d-flex flex-column flex-grow-1 mr-2 px-1 ">
                                        <label for="fecha_inicio" class="form-label @error('fecha_inicio') is-invalid @enderror" style="font-weight: bolder">
                                            Fecha de inicio
                                        </label>
                                        <input id="fecha_inicio" name="fecha_inicio" type="date" class="form-control" style="text-align-last:left;"
                                               value="{{ request('fecha_inicio', old('fecha_inicio')) }}">
                                        @error('fecha_inicio')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div> 
                                    <div class=" col-md-6 d-flex flex-column flex-grow-1 mr-2">
                                        <label for="fecha_cierre" class="form-label @error('fecha_cierre') is-invalid @enderror" style="font-weight: bolder">
                                            Fecha de cierre
                                        </label>
                                        <input id="fecha_cierre" name="fecha_cierre" type="date" class="form-control" style="text-align-last:left;"
                                               value="{{ request('fecha_cierre', old('fecha_cierre')) }}">
                                        @error('fecha_cierre')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>                                   
                                </div>
                                <br>
                                <button type="submit" class="btn btn-dark">Filtrar</button>
                            </form>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group d-flex align-items-center">
                                <div class="d-flex flex-column flex-grow-1 mr-2 mb-2">
                                    <label for="categoria" class="form-label" style="font-weight: bolder">Categoría Del Producto</label>
                                    <input disabled id="name" name="name" class="selectpicker form-control" data-live-search="true" style="text-align-last:left;"></input>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <div class="d-flex flex-column flex-grow-1 mr-2 mb-2">
                                    <label for="subcategoria" class="form-label" style="font-weight: bolder">Estado</label>
                                    <input disabled id="status" name="status" class="selectpicker form-control" data-live-search="true" style="text-align-last:left;"></input>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="table_container">
                        <div>
                            <table class="table table-striped table-hover" style="justify-content: center; width: 100%" id="datatable">
                                <thead class="table-dark" >
                                    <tr style="text-align: center">
                                        <th>Categoría</th>
                                        <th>Subcategoría</th>
                                        <th>Nombre del producto</th>
                                        <th>Referencia de Fabrica</th>
                                        <th>N° Factura</th>
                                        <th>Fecha de la Factura</th>
                                        <th>Cantidad</th>
                                        <th>Total Bruto</th>
                                        <th>Descuento</th>
                                        <th>Subtotal</th>
                                        <th>Impuesto cargo</th>
                                        <th>Total Neto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $ventas)
                                    <tr>
                                        <td style="text-align: center">
                                            {{$ventas->product->categoryProduct->name }}
                                        </td>
                                        <td style="text-align: center">
                                            {{$ventas->product->subcategory_product }}
                                        </td>
                                        <td style="text-align: center">
                                            {{$ventas->product->name_product }}
                                        </td>
                                        <td style="text-align: center">
                                            {{$ventas->product->factory_reference }}
                                        </td>
                                        <td style="text-align: center">
                                            {{$ventas->id }}
                                        </td>
                                        <td style="text-align: center">
                                            {{ $ventas->created_at->format('d/m/Y') }}
                                        </td>
                                        <td style="text-align: center">
                                            {{$ventas->quantity_units}}
                                        </td>
                                        <td style="text-align: center">
                                            {{$ventas->total_value }}
                                        </td>
                                        <td style="text-align: center">
                                            {{$ventas->discount_total }}
                                        </td>
                                        <td style="text-align: center">
                                            {{-- {{($ventas->amount) * ($ventas->selling_price) - ($ventas->discounts)}} --}}
                                        </td>
                                        <td style="text-align: center">
                                            {{ $ventas->product_tax }}
                                        </td>
                                        <td style="text-align: center">
                                            {{ $ventas->net_total }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>
                
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

    $('#product_id').change(mostrarValores);
    });

    function mostrarValores() {
        let dataProducto = document.getElementById('product_id').value.split('-');
        console.log(dataProducto)
        $('#name').val(dataProducto[1]);
        $('#status').val(dataProducto[2]);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>

    <script>
    new DataTable('#datatable',{
        responsive: true,
        lengthChange: true,
        // paging: false,
        searching: false,
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "<<",
                "sLast":     ">>",
                "sNext":     ">",
                "sPrevious": "<"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        layout: {
            topRight: {
                buttons: [ 
                    {
                        'extend': 'excelHtml5',
                        'text': '<i class="fa fa-file-excel"></i>',
                        'titleAtter': 'Excel',
                        'className': 'btn btn-warning',
                    },
                    {
                        'extend': 'pdfHtml5',
                        'text': '<i class="fa fa-file-pdf"></i>',
                        'className': 'btn btn-success'
                    }
                ]
            }
        }
    });
</script>
@endauth
@guest
    @include('include.falta_sesion')
@endguest
