@auth
    @include('include.barra', ['modo' => 'Detalle De Compra'])
@can('detail-purchases')

    <head>
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
       {{-- <link href="{{ asset('css/products/all.css') }}" rel="stylesheet" />--}}
        <link href="css/estilos_notificacion.css" rel="stylesheet" />
        <script src="{{ asset('js/tooltips.js') }}" defer></script>
        <script src="{{ asset('js/notificaciones.js') }}" defer></script>
    </head>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h2 id="card_title">
                            {{ Breadcrumbs::render('detail.purchase') }}
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">Acciones</button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('purchase_supplier.index') }}">Mostrar
                                                Compras</a></li>
                                        <li><a class="dropdown-item" href="{{ route('detail-purchases.create') }}">Crear
                                                Detalle Compra</a></li>
                                        <li><a class="dropdown-item" href="{{ route('debit-note-supplier.index') }}">Mostrar
                                                notas debito</a></li>
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
        <div class="container_datos">
            <div class="table_container">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" style="justify-content: center">
                        <thead class="table-dark">
                            <tr style="text-align: center">
                                <th>No</th>
                                <th>Tipo Documento</th>
                                <th>Numero Documento</th>
                                <th>Proveedor</th>
                                <th>Producto</th>
                                <th>Total Neto</th>
                                <th>Iva</th>
                                <th>Total</th>
                                <th>Descuento</th>
                                <th>Metodo de Pago</th>
                                <th>Estado</th>
                                <th>Acciones</th>
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
                    {!! $detailPurchases->links() !!}
                </div>
            </div>
        </div>
    </div>
    @include('detail-purchase.modal')
@endcan
@endauth

@guest
    @include('include.falta_sesion')
@endguest
