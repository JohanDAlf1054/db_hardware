@auth
    @include('include.barra', ['modo' => 'Detalle De Compra'])
<br>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
<link href="css/estilos_notificacion.css" rel="stylesheet"/>
<script src="{{ asset('js/notificaciones.js')}}" defer></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
<script src="{{ asset('js/tooltips.js') }}" defer></script>
</head>
@can('detail-purchases')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                            {{ Breadcrumbs::render('detail.purchase') }}
                    </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">Acciones</button>
                                        <ul class="dropdown-menu desplegable_acciones">
                                        <div class="acciones_boton">
                                        <li><a class="dropdown-item" href="{{ route('detail-purchases.create') }}">Crear
                                                Detalle Compra</a></li>
                                        <li><a class="dropdown-item" href="{{ route('debit-note-supplier.index') }}">Mostrar
                                                notas debito</a></li>
                                        <li><a class="dropdown-item" href="{{ route('purchase_supplier.index') }}">Mostrar
                                                    Compras</a></li>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <form action="{{ route('detail-purchases.index') }}" method="get"
                                    class="d-flex align-items-center">
                                    <input name="filtervalue" type="text" class="form-control"
                                        aria-label="Text input with segmented dropdown button"
                                        placeholder="Buscar Compra....">
                                    <button type="submit" class="btn btn-dark" style="margin-left: 10px;">Buscar</button>
                                </form>
                            </div>
                        </div>
                    </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const mensajeFlash = {!! json_encode(Session::get('notificacion')) !!};
                if (mensajeFlash) {
                    agregarnotificacion(mensajeFlash);
                }
            });
        </script>
        <div class="contenedor-notificacion" id="contenedor-notificacion">
        </div>
        <style>
            #example th, #example td {
                text-align: center !important;
            }
        </style>
        <div class="container_datos">
            <div class="table_container p-3">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" style="width:100%" id="example">
                        <thead class="table-dark">
                            <tr style="text-align: center">
                                <th style="text-align: center">No</th>
                                <th style="text-align: center">Tipo Documento</th>
                                <th style="text-align: center">Numero Documento</th>
                                <th style="text-align: center">Proveedor</th>
                                <th style="text-align: center">Producto</th>
                                <th style="text-align: center">Total Neto</th>
                                <th style="text-align: center">Iva</th>
                                <th style="text-align: center">Total</th>
                                <th style="text-align: center">Descuento</th>
                                <th style="text-align: center">Metodo de Pago</th>
                                <th style="text-align: center">Estado</th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($detailPurchases as $detailPurchase)
                                <tr style="text-align: center;">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ optional($detailPurchase->purchaseSupplier->person)->identification_type ?? 'Error: No se encontró el proveedor' }}
                                    </td>
                                    <td>{{ optional($detailPurchase->purchaseSupplier->person)->identification_number ?? 'Error: No se encontró el proveedor' }}
                                    </td>

                                    <td>{{ optional($detailPurchase->purchaseSupplier->person)->first_name ?? 'Error: No se encontró el proveedor' }}
                                    </td>
                                    <td>{{ optional($detailPurchase->product)->name_product ?? 'Error: No se encontró el producto' }}
                                    </td>

                                    <td>{{ $detailPurchase->net_total }}</td>
                                    <td>{{ $detailPurchase->product_tax }}%</td>
                                    <td>{{ $detailPurchase->total_value }}</td>
                                    <td>{{ $detailPurchase->discount_total }}</td>
                                    <td>{{ $detailPurchase->form_of_payment }}</td>
                                    <td>
                                        @if ($detailPurchase->status == 1)
                                            <p class="badge rounded-pill bg-success text-dark" style="font-size: 15px">
                                                Activo</p>
                                        @else
                                            <p class="badge rounded-pill bg-danger" style="font-size: 15px">Inactivo</p>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('detail-purchases.destroy', $detailPurchase->id) }}"
                                            method="POST">
                                            <a class="btn btn-sm btn-primary" tooltip="tooltip"
                                            title="Visualizar"
                                                href="{{ route('detail-purchases.show', $detailPurchase->id) }}"><i
                                                    class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                                            {{-- <a class="btn btn-sm btn-success" href="{{ route('detail-purchases.edit',$detailPurchase->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                --}} @csrf
                                            @method('DELETE')
                                            @if ($detailPurchase->status == true)
                                                <button type="button" class="btn btn-danger btn-sm"data-bs-toggle="modal"
                                                tooltip="tooltip"
                                                title="Inactivar"
                                                    data-bs-target="#confirmationDestroy-{{ $detailPurchase->id }}"><i
                                                        class="fa fa-fw fa-trash"></i></button>
                                            @else
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                tooltip="tooltip"
                                                title="Activar"
                                                    data-bs-target="#confirmationDestroy-{{ $detailPurchase->id }}"><i
                                                        class="fa-solid fa-rotate"></i></button>
                                            @endif
                                        </form>
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
{!! $detailPurchases->links() !!}
</div>
            
      
    @include('detail-purchase.modal')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
<script>
    new DataTable('#example',{
        responsive: true,
        lengthChange: false,
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
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
    });
</script>
    @else
    <div class="mensaje_Rol">
        <img src="{{ asset('img/Rol_no_asignado.png')}}" class="img_rol"/>
        <h2 class="texto_noRol">Pídele al administrador que se te asigne un rol.</h2>
    </div>
@endcan
@endauth

@guest
    @include('include.falta_sesion')
@endguest
