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
                        
                        <div class="col-lg-6 col-md-6 col-sm-12" >
                           <input type="text" wire:model.live='criterio' class="form-control" placeholder="Buscar ...">
                        </div>
                        {{--  {{$criterio}}  --}}
                      </div>
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
                                    <th>Observaciones</th>
                                    <th>Total descuento</th>
                                    <th>Total Bruto</th>
                                    <th>Total Impuesto</th>
                                    <th>Total Neto</th>
                                    <th>Total</th>  
                                    <th>Acciones</th> 
                                </tr>
                            </thead>
                            <tbody>
                                {{--  @foreach ($sales as $sale)
                                    <tr style="text-align: center">
                                        <td>{{$sale->id}}</td>
                                        <td>{{$sale->dates}}</td>
                                        <td>{{$sale->bill_numbers}}</td>
                                        <td>{{$sale->sellers}}</td>
                                        <td>{{$sale->payments_methods}}</td>
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
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
            </div>
           {{--  {{ $sales->links()}}   --}}
        </div>
    </div>
@endsection

@push('js')
    
@endpush