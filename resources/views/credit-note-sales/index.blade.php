@auth
@can('sales')

@extends('template')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <br>
            <div class="card">
                <div class="card-header">
                    <h2 id="card_title">
                        {{ Breadcrumbs::render('credit.note.sales') }}
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
                                    <li><a class="dropdown-item" href="{{ route('credit-note-sales.index') }}">Nota crédito</a></li>
                                    <li><a class="dropdown-item" href="{{ route('credit-note-sales.create') }}">Crear nota crédito</a></li>
                                </div>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <form action="{{ route('person.index') }}" method="get" class="d-flex align-items-center">
                                <input name="filtervalue" type="text" class="form-control me-2"
                                    aria-label="Buscar persona" placeholder="Buscar Nota Crédito....">
                                <button type="submit" class="btn btn-dark">Buscar</button>

                                {{-- Botones IMPORTAR Y EXPORTAR --}}

                                <button type="button" class="btn btn-success ms-2 rounded" data-bs-toggle="tooltip"
                                    title="Exportar" onclick="window.location.href='{{ route('export.creditnotesale') }}'">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </button>
                                <button type="button" class="btn btn-danger ms-2 rounded" tooltip="tooltip"
                                    title="PDF" onclick="window.location.href='{{ route('credit-note-sales.pdf') }}'">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="container_datos">
                        <div class="table_container">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-hover display nowrap"  style="justify-content: center; width:100%">
                                    <thead class="table-dark">
                                        <tr style="text-align: center">
                                            <th>Id</th>
                                            <th>Fecha de venta</th>
                                            <th>Vendedor</th>
                                            <th>Forma de pago</th>
                                            <th>Total Bruto</th>
                                            <th>Total Impuesto</th>
                                            <th>Total Neto</th>
                                            <th>Fecha Nota Crédito</th>
                                            <th>Motivo</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ventas as $sale)
                                        <tr style="text-align: center">
                                            <td>{{$sale->id}}</td>
                                            <td>{{$sale->date_invoice}}</td>
                                            <td>{{$sale->sellers}}</td>
                                            <td>{{$sale->payments_methods}}</td>
                                            <td>{{$sale->gross_totals}}</td>
                                            <td>{{$sale->taxes_total}}</td>
                                            <td>{{$sale->net_total}}</td>
                                            <td>{{$sale->date_credit_notes}}</td>
                                            <td>{{$sale->reason}}</td>
                                            <td>
                                                @if($sale->status == True)
                                                <p class="badge rounded-pill bg-success" style="font-size: 15px">Activo</p>
                                                @else
                                                <p class="badge rounded-pill bg-danger" style="font-size: 15px">Inactivo</p>
                                                @endif
                                            </td>
                                            <td class="border px-4 py-2 text-center">
                                                <div class="d-inline-block">
                                                    <form action="{{ route('credit-note-sales.show', ['credit_note_sale' => $sale]) }}" method="get">
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
                                                    </button>
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
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <form action="{{ route('credit-note-sales.destroy',['credit_note_sale'=>$sale->id]) }}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Confirmar</button>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@else
    <div class="mensaje_Rol">
        <img src="{{ asset('img/Rol_no_asignado.png')}}" class="img_rol"/>
        <h2 class="texto_noRol">Pídele al administrador que se te asigne un rol.</h2>
    </div>
@push('js')
<script src="{{ asset('js/datatable.js') }}" defer></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
@endpush
@endcan
@endauth
@guest
    @include('include.falta_sesion')
@endguest

