@auth
@include('include.barra', ['modo'=>'Notas Debito'])
@can('debit-note-supplier')

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
    <link href="css/estilos_notificacion.css" rel="stylesheet"/>
    <script src="{{ asset('js/notificaciones.js')}}" defer></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
    <script src="{{ asset('js/tooltips.js') }}" defer></script>
    </head>
    <br>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{ Breadcrumbs::render('debit-note-supplier.index') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                {{-- Desplegable de opciones --}}
                                <div class="dropdown">
                                    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">Acciones</button>
                                    <ul class="dropdown-menu">
                                    {{-- <li><a class="dropdown-item" href="{{ route('purchase_supplier.index') }}">Mostrar Las Compras A Proveedor</a></li>--}}
                                    <li><a class="dropdown-item" href="{{ route('debit-note-supplier.create') }}">Crear Nueva Nota Debito</a></li>

                                    <li><a class="dropdown-item" href="{{ route('detail-purchases.index') }}">Mostrar Detalles De Compras</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12" >
                                <form action="{{ route('debit-note-supplier.index') }}" method="get" class="d-flex align-items-center">
                                    <input name="filtervalue" type="text" class="form-control" aria-label="Text input with segmented dropdown button"  placeholder="Buscar Nota....">
                                    <button type="submit" class="btn btn-dark" style="margin-left: 10px;">Buscar</button>
                                    <button type="button" class="btn btn-success ms-2 rounded" data-bs-toggle="tooltip"
                                    title="Exportar" onclick="window.location.href='{{ route('export.debitnote') }}'">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Script  para mostrar la notificacion --}}
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const mensajeFlash = {!! json_encode(Session::get('notificacion')) !!};
                            if (mensajeFlash) {
                                agregarnotificacion(mensajeFlash);
                            }
                        });
                    </script>
                    {{--  Div con las notificaciones nuevas  --}}
                    <div class="contenedor-notificacion" id="contenedor-notificacion">
                        {{--  Aqui trae las notificaciones por medio de javascript  --}}
                    </div>
                    <style>
                        #example th, #example td {
                            text-align: center !important;
                        }
                    </style>
                <div class="container_datos">
                        <div class="table_container p-3">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-hover" style="width:100%">
                                    <thead class="table-dark">
                                        <tr style="text-align: center">
                                                <th>No</th>
                                                <th>Tipo Documento</th>
                                                <th>Numero Documento</th>
                                                <th>Proveedor</th>
                                                <th>Numero de Nota</th>
                                                <th>Fecha De La Nota</th>
                                                <th>Total</th>
                                                <th>Descuento Total</th>
                                                <th>Impuesto Producto</th>
                                                <th>Cantidad</th>
                                                <th>Método de Pago</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($debitNoteSuppliers as $key =>  $debitNoteSupplier)
                                            <tr style="text-align: center;">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ optional($debitNoteSupplier->detailPurchase->purchaseSupplier->person)->identification_type ?? 'Error: No se encontró el Empleado' }}</td>
                                                <td>{{ optional($debitNoteSupplier->detailPurchase->purchaseSupplier->person)->identification_number ?? 'Error: No se encontró el Empleado' }}</td>

                                                <td>
                                                    @if(optional($debitNoteSupplier->purchaseSupplier->person)->person_type === 'Persona jurídica')
                                                        {{ optional($debitNoteSupplier->purchaseSupplier->person)->company_name ?? 'Error: No se encontró la Empresa' }}
                                                    @else
                                                        {{ optional($debitNoteSupplier->purchaseSupplier->person)->first_name ?? 'Error: No se encontró el Empleado' }} {{ optional($debitNoteSupplier->purchaseSupplier->person)->other_name ?? '' }}
                                                    @endif
                                                </td>
                                                <td>{{ $debitNoteSupplier->debit_note_code}}</td>
                                                <td>{{ $debitNoteSupplier->date_invoice }}</td>
                                                <td>{{ round($debitNoteSupplier->total, 2) }}</td>
                                                <td>{{ $debitNoteSupplier->detailPurchase ? $debitNoteSupplier->detailPurchase->discount_total : 'N/A' }}</td>
                                                <td>{{ $debitNoteSupplier->detailPurchase ? $debitNoteSupplier->detailPurchase->product_tax : 'N/A' }}</td>
                                                <td>{{ $debitNoteSupplier->quantity}}</td>
                                                <td>{{ $debitNoteSupplier->detailPurchase ? $debitNoteSupplier->detailPurchase->form_of_payment : 'N/A' }}</td>
                                                <td>
                                                    @if ($debitNoteSupplier->status == 1)
                                                        <p class="badge rounded-pill bg-success text-dark" style="font-size: 15px">Activo</p>
                                                    @else
                                                        <p class="badge rounded-pill bg-danger"  style="font-size: 15px">Inactivo</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('debit-note-supplier.destroy',$debitNoteSupplier->id) }}" method="POST">
                                                        <a class="btn btn-sm btn-primary "tooltip="tooltip"
                                                        title="Visualizar" href="{{ route('debit-note-supplier.show',$debitNoteSupplier->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        @if ($debitNoteSupplier->status == true)
                                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"tooltip="tooltip"
                                                            title="Inactivar"  data-bs-target="#confirmationDestroy-{{$debitNoteSupplier->id}}"><i class="fa fa-fw fa-trash"></i></button>

                                                            @else
                                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"tooltip="tooltip"
                                                            title="Activar"  data-bs-target="#confirmationDestroy-{{$debitNoteSupplier->id}}"><i class="fa-solid fa-rotate"></i></button>
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
        
    </div>


@include('debit-note-supplier.modal')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="{{ asset('js/datatable.js') }}" defer></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>


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

