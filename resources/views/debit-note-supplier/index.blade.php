@auth
@include('include.barra', ['modo'=>'Notas Debito'])


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
                    <li><a class="dropdown-item" href="{{ route('purchase_supplier.index') }}">Mostrar Las Compras A Proveedor</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('detail-purchases.index') }}">Mostrar Detalles De Compras</a>
                    </li>
                   {{-- <li>
                        <a class="dropdown-item" href="{{ route('credit-note-supplier.index') }}">Crear Una nota Credito</a>
                    </li>--}}
                    <li>
                        <a class="dropdown-item" href="{{ route('debit-note-supplier.create') }}">Crear Nueva Nota Debito</a>
                    </li>
                            </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12" >
                        <form action="{{ route('debit-note-supplier.index') }}" method="get">
                            <div class="mb-3 row">
                                <div class="col-sm-9">
                                    <input name="filtervalue" type="text" class="form-control" aria-label="Text input with segmented dropdown button"  placeholder="Buscar Nota....">
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
                                    <th>Empleado</th>
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
                                @foreach ($debitNoteSuppliers as $debitNoteSupplier)
                                <tr style="text-align: center;">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ optional($debitNoteSupplier->detailPurchase->purchaseSupplier->person)->identification_type ?? 'Error: No se encontró el proveedor' }}</td>
                                    <td>{{ optional($debitNoteSupplier->detailPurchase->purchaseSupplier->person)->identification_number ?? 'Error: No se encontró el proveedor' }}</td>

                                    <td>{{ optional($debitNoteSupplier->detailPurchase->purchaseSupplier->person)->first_name ?? 'Error: No se encontró el proveedor' }}</td>
                                    <td>{{ $debitNoteSupplier->debit_note_code}}</td>
                                    <td>{{ $debitNoteSupplier->date_invoice }}</td>
                                    <td>{{ round($debitNoteSupplier->total, 2) }}</td>
                                    <td>{{ $debitNoteSupplier->detailPurchase ? $debitNoteSupplier->detailPurchase->discount_total : 'N/A' }}</td>
                                    <td>{{ $debitNoteSupplier->detailPurchase ? $debitNoteSupplier->detailPurchase->product_tax : 'N/A' }}</td>
                                    <td>{{ $debitNoteSupplier->quantity}}</td>
                                    <td>{{ $debitNoteSupplier->detailPurchase ? $debitNoteSupplier->detailPurchase->form_of_payment : 'N/A' }}</td>
                                    <td>
                                        @if ($debitNoteSupplier->status == 1)
                                            <p class="badge rounded-pill bg-warning text-dark" style="font-size: 15px">Activo</p>
                                        @else
                                            <p class="badge rounded-pill bg-danger"  style="font-size: 15px">Inactivo</p>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('debit-note-supplier.destroy',$debitNoteSupplier->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('debit-note-supplier.show',$debitNoteSupplier->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                                            @csrf
                                            @method('DELETE')
                                            @if ($debitNoteSupplier->status == true)
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationDestroy-{{$debitNoteSupplier->id}}"><i class="fa fa-fw fa-trash"></i></button>
                                            @else
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationDestroy-{{$debitNoteSupplier->id}}"><i class="fa-solid fa-rotate"></i></button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                
            {!! $debitNoteSuppliers->links() !!}
        </div>
    </div>
</div>
</div>
@include('debit-note-supplier.modal')
    @endauth
    @guest
        @include('include.falta_sesion')
    @endguest
