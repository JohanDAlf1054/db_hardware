@auth
@include('include.barra', ['modo'=>'Detalle De Compra'])


<div class="container-fluid">
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body"></div>
            <div class="row">
                
            <div class="col-lg-6 col-md-6 col-sm-12" >
                    
                <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Acciones
                    <span class="visually-hidden">Acciones</span>
                {{-- <div style="display: flex; justify-content: space-between; align-items: center;"> --}}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">    
                    <li>
                        <a class="dropdown-item" href="{{ route('detail-purchases.create') }}">Crear Detalle De Compra</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('purchase_supplier.index') }}">Mostrar Compras a Proveedores</a>
                    </li>
                    {{-- <li>
                        <a class="dropdown-item" href="{{ route('credit-note-supplier.index') }}">Crear Una nota Credito</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('debit-note-supplier.index') }}">Crear Una nota debito</a>
                    </li>--}}
                            </ul>
                    </div>
            
                        <div class="col-lg-6 col-md-6 col-sm-12" >
                            <form action="{{ route('detail-purchases.index') }}" method="get">
                                <div class="mb-3 row">
                                    
                                    <div class="col-sm-9">
                                        <input name="filtervalue" type="text" class="form-control" aria-label="Text input with segmented dropdown button"  placeholder="Buscar Producto....">
                                    </div>
                                    <div class=" col-sm-3">
                                        <button type="submit" class=" btn btn-dark">Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                        
                    </div>
                </div>
                
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
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
                                            <td>{{ optional($detailPurchase->purchaseSupplier->person)->identification_type ?? 'Error: No se encontró el proveedor' }}</td>
                                            <td>{{ optional($detailPurchase->purchaseSupplier->person)->identification_number ?? 'Error: No se encontró el proveedor' }}</td>

                                            <td>{{ optional($detailPurchase->purchaseSupplier->person)->first_name ?? 'Error: No se encontró el proveedor' }}</td>
                                            <td>{{ optional($detailPurchase->product)->name_product ?? 'Error: No se encontró el producto' }}</td>
                                
                                            <td>{{ $detailPurchase->net_total }}</td>
                                            <td>{{ $detailPurchase->product_tax }}%</td>
                                            <td>{{ $detailPurchase->total_value }}</td>
                                            <td>{{ $detailPurchase->discount_total }}</td>
                                            <td>{{ $detailPurchase->form_of_payment }}</td>
                                            <td>
                                                <form action="{{ route('detail-purchases.destroy',$detailPurchase->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('detail-purchases.show',$detailPurchase->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('detail-purchases.edit',$detailPurchase->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
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
    @endauth
    @guest
        @include('include.falta_sesion')
    @endguest
