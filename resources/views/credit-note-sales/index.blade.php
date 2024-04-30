@extends('template')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                </div>
                <div class="card-body" >
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12" >
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Acciones
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

                        <div class="col-lg-3 col-md-5 col-sm-7" >
                            <form action="{{ route('sales.index') }}" method="get">
                                <div class="mb-2 row">
                                    <div class="col-sm-9">
                                        <input name="filtervalue" type="text" class="form-control" aria-label="Text input with segmented dropdown button"  placeholder="Buscar Factura....">
                                    </div>
                                    <div class=" col-sm-3">
                                        <button type="submit" class=" btn btn-dark">Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6"  >
                            <form action="{{ route('credit-note-sales.index') }}" method="GET">
                                <div class="mb-3 row" >
                                    <div class="col-sm-4" style="display: flex; margin-left: 1rem">
                                        <input name="check" class="form-check-input" type="checkbox" style="padding: 0.7rem; " {{ request('check') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkActivos" style="font-size: 1.1em; padding: 0.2rem; " >Activos</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class=" btn btn-dark">Filtrar</button>
                                    </div>
                            </form>
                        </div>



                      </div>
                </div>

                <div class="container_datos">
                    <div class="table_container">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover" style="justify-content: center">
                            <thead class="table-dark">
                                <tr style="text-align: center">
                                    <th>Id</th>
                                    <th >Nº de factura</th>
                                    <th >Fecha nota credito</th>
                                    <th>Vendedor</th>
                                    <th>Forma de pago</th>
                                    <th>Motivo<th>
                                    <th>Fecha de venta</th>
                                    <th>Total Bruto</th>
                                    <th>Total Impuesto</th>
                                    <th>Total Neto</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                 {{-- @foreach ($ventas as $sale)
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
                                            <p class="badge rounded-pill bg-warning text-dark" style="font-size: 15px">Activo</p>
                                            @else
                                            <p class="badge rounded-pill bg-danger"  style="font-size: 15px">Inactivo</p>
                                            @endif
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <div class="d-inline-block">
                                                <form action="{{ route('sales.show', ['sale' => $sale]) }}" method="get">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fa fa-fw fa-eye"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="d-inline-block">
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$sale->id}}">
                                                    <i class="fa fa-fw fa-trash"></i>
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
                                                    ¿Seguro que quieres inactivar el registro?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <form action="{{ route('sales.destroy',['sale'=>$sale->id]) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  @endforeach   --}}
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
            </div>
           {{-- {{ $sales->links()}} --}}
        </div>
    </div>
@endsection
