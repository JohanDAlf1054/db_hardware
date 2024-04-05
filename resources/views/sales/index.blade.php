@extends('template')

@push('css')
    
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                 
                </div>
                <div class="card-body" >
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12" >
                            <a href="{{route('sales.create')}}">
                                <button type="button" class="btn btn-primary mx-2 rounded btn-lg">Añadir nuevo registro</button>
                            </a>
                        </div>
                        
<<<<<<< HEAD
                        <!-- <div class="col-lg-6 col-md-6 col-sm-12" >
                           <input type="text" wire:model.live='criterio' class="form-control" placeholder="Buscar ...">
                        </div>
                        {{--  {{$criterio}}  --}}
                      </div> -->
=======
                        <div class="col-lg-6 col-md-6 col-sm-12" >
                           <input type="text" wire:model.live='criterio' class="form-control" placeholder="Buscar ...">
                        </div>
                        {{--  {{$criterio}}  --}}
                      </div>
>>>>>>> 3a6966a75a2488e27d83d21014ef8576ae476adc
                </div>

                <div class="container_datos">
                    <div class="table_container">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover" style="justify-content: center">
                            <thead class="table-dark">
                                <tr style="text-align: center">
                                    <th>Id</th>
                                    <th >Fecha</th>
                                    <th >Nº de factura</th>
                                    <th>Vendedor</th>
                                    <th>Forma de pago</th>
<<<<<<< HEAD
                                    <th>Total Bruto</th>
                                    <th>Total Impuesto</th>
                                    <th>Total Neto</th>
=======
                                    <th>Total descuento</th>
                                    <th>Total Impuesto</th>
                                    <th>Total Neto</th>
                                    <th>Total</th>  
>>>>>>> 3a6966a75a2488e27d83d21014ef8576ae476adc
                                    <th>Acciones</th> 
                                </tr>
                            </thead>
                            <tbody>
<<<<<<< HEAD
                                 @foreach ($ventas as $sale)
=======
                                {{--  @foreach ($sales as $sale)
>>>>>>> 3a6966a75a2488e27d83d21014ef8576ae476adc
                                    <tr style="text-align: center">
                                        <td>{{$sale->id}}</td>
                                        <td>{{$sale->dates}}</td>
                                        <td>{{$sale->bill_numbers}}</td>
                                        <td>{{$sale->sellers}}</td>
                                        <td>{{$sale->payments_methods}}</td>
<<<<<<< HEAD
                                        <td>{{$sale->gross_totals}}</td>
                                        <td>{{$sale->taxes_total}}</td>
                                        <td>{{$sale->net_total}}</td>
                                          <td class="border px-4 py-2 text-center">
                                            <form action="{{route('sales.show', ['sale'=>$sale]) }}" method="get">
                                                <button type="submit" class="btn btn-success">
                                                    Ver
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$sale->id}}">Eliminar</button>
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
                                                    ¿Seguro que quieres eliminar el registro?
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
                                  @endforeach  
=======
                                        <td>{{$sale->observations}}</td>
                                        <td>{{$sale->discounts_total}}</td>
                                        <td>{{$sale->gross_totals}}</td>
                                        <td>{{$sale->taxes_total}}</td>
                                        <td>{{$sale->net_total}}</td>
                                        <td>{{$sale->values_total}}</td>  --}}
                                        {{--  <td class="border px-4 py-2 text-center">
                                            <button wire:click="editar({{$sale->id}})" data-bs-toggle="modal" data-bs-target="#SaleModal" class="btn btn-sm btn-success">Editar</button>
                                            <button wire:click="borrar({{$sale->id}})" class="btn btn-danger btn-sm">Borrar</button>
                                        </td>  --}}
                                    </tr>
                                {{--  @endforeach  --}}
>>>>>>> 3a6966a75a2488e27d83d21014ef8576ae476adc
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
            </div>
<<<<<<< HEAD
           {{-- {{ $sales->links()}} --}}
=======
           {{--  {{ $sales->links()}}   --}}
>>>>>>> 3a6966a75a2488e27d83d21014ef8576ae476adc
        </div>
    </div>
@endsection

@push('js')
    
@endpush