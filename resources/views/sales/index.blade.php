@extends('template')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <br>
            <div class="card">
                <div class="card-header">
                    <h2 id="card_title">
                        {{ Breadcrumbs::render('sales.index') }}
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Acciones
                                <span class="visually-hidden">Acciones</span>
                            </button>
                            <ul class="dropdown-menu desplegable_acciones">
                                <div class="acciones_boton">
                                    <li><a class="dropdown-item" href="{{ route('sales.create') }}">Crear nueva venta</a></li>
                                    <li><a class="dropdown-item" href="{{ route('credit-note-sales.index') }}">Nota credito</a></li>
                                    <li><a class="dropdown-item" href="{{ route('credit-note-sales.create') }}">Crear nota credito</a></li>
                                </div>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-7">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <form action="{{ route('sales.index') }}" method="GET">
                                <div class="mb-3 row">
                                    <div class="col-sm-8" style="display: flex; margin-left: 1rem">
                                        <input name="check" class="form-check-input" type="checkbox" style="padding: 0.7rem; " {{ request('check') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkActivos" style="font-size: 1.1em; padding: 0.2rem; " >Activos</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-dark">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>  
        
                <div class="table-responsive px-3"> <!-- Añade la clase "px-3" para agregar margen horizontal -->
                            <table id="example" class="table table-striped table-hover display nowrap"  style="justify-content: center; width:100%">
                                <thead class="table-dark">
                                    <tr style="text-align: center">
                                        <th>Id</th>
                                        <th>Fecha</th>
                                        <th>Nº de factura</th>
                                        <th>Vendedor</th>
                                        <th>Forma de pago</th>
                                        <th>Total Bruto</th>
                                        <th>Total Impuesto</th>
                                        <th>Total Neto</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
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
                                        <td class="border px-4 py-2 text-center">
                                            <div class="d-inline-block">
                                                <form action="{{ route('sales.show', ['sale' => $sale]) }}" method="get">
                                                    <button type="submit" class="btn btn-primary btn-sm" tooltip="tooltip" title="Visualizar">
                                                        <i class="fa fa-fw fa-eye"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="d-inline-block">
                                                @if ($sale->status == true)
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" tooltip="tooltip" title="Inactivar" data-bs-target="#confirmModal-{{$sale->id}}"><i class="fa fa-fw fa-trash"></i></button>
                                            @else
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" tooltip="tooltip" title="Activar" data-bs-target="#confirmModal-{{$sale->id}}"><i class="fa-solid fa-rotate"></i></button>
                                            @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="confirmModal-{{$sale->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @if ($sale->status == true)
                                                    ¿Seguro que quieres inactivar el registro?
                                                @else
                                                    ¿Seguro que quieres activar el registro?
                                                @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                                                    <form action="{{ route('sales.destroy',['sale'=>$sale->id]) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">Confirmar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                   
            
            </div>
           {{-- {{ $sales->links()}} --}}
        </div>
    </div>
</div>
@endsection


@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script> 
        <script src ="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>             
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>

<script>
    new DataTable('#example',{
        responsive: true,   
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
            buttons: [
       
       {
           extend: 'excel',
           text: '<i class="fa-solid fa-file-excel"></i>',
           className: 'btn btn-success'
       },
      
       {
           extend: 'pdf',
           text: '<i class="fa-solid fa-file-pdf"></i>',
           className: 'btn btn-danger'
        }
    ],
        lengthMenu: [5, 10, 25, 50]
       
    });
</script>
@endpush
