@auth
@include('include.barra', ['modo'=>'Compra Proveedor'])
@can('purchase_supplier')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
        <br>
    <div class="card">
        <div class="card">
                <div class="card-header">
                    <h2 id="card_title">
                        {{ Breadcrumbs::render('compras.index') }}
                    </h2>
                </div>
                <div class="card-body"></div>
            <div class="row">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12" >
                            <div class="dropdown">
                                <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >Acciones</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('detail-purchases.index') }}">Mostrar Detalles De Compras</a></li>
                                    <li><a class="dropdown-item" href="{{ route('debit-note-supplier.index') }}">Mostrar  notas debito</a></li>
                                </ul>
                            </div>
                        </div>
                            <div class="col-lg-6 col-md-6 col-sm-12" >
                                <form action="{{ route('detail-purchases.index') }}" method="get" class="d-flex align-items-center">
                                    <input name="filtervalue" type="text" class="form-control" aria-label="Text input with segmented dropdown button"  placeholder="Buscar Una Compra Realizada A Proveedor....">
                                    <button type="submit" class=" btn btn-dark"  style="margin-left: 10px;" >Buscar</button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const mensajeFlash = {!! json_encode(Session::get('notificacion')) !!};
                    if (mensajeFlash) {
                        agregarnotificacion(mensajeFlash);
                    }
                });
            </script>
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
                                    <th>Numero Factura De Proveedor</th>
                                    <th>Fecha De Compra</th>
                                    <th>Acciones</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 0;
                                @endphp
                                    @foreach ($purchaseSuppliers as $purchaseSupplier)
                                    <tr>
                                        <td style="text-align: center;">{{ ++$i }}</td>
                                        <td>{{ $purchaseSupplier->person ? $purchaseSupplier->person->identification_type : 'N/A' }}</td>
                                        <td>{{ $purchaseSupplier->person ? $purchaseSupplier->person->identification_number : 'N/A' }}</td>
                                        <td >{{ $purchaseSupplier->person ? $purchaseSupplier->person->first_name : 'N/A' }}</td>
                                        <td style="text-align: center;">{{ $purchaseSupplier->invoice_number_purchase }}</td>
                                        <td style="text-align: center;">{{ $purchaseSupplier->date_invoice_purchase }}</td>
                                        <td style="text-align: center;">
                                            <form action="{{ route('purchase_supplier.destroy',$purchaseSupplier->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('purchase_supplier.show',$purchaseSupplier->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('purchase_supplier.edit',$purchaseSupplier->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                            </form>
                                                                                    </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $purchaseSuppliers->links() !!}
            </div>
        </div>
    </div>
    </div>
    @endcan
    @endauth
    @guest
        @include('include.falta_sesion')
    @endguest
