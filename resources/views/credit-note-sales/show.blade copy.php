@extends('template')

@section('title','Ver nota crédito')
<div class="bread_crumb">
    {{ Breadcrumbs::render('credit.note.sales.show', $credit_note_sale) }}
</div>
<br>
@section('content')

@push('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush

<div class="content container-fluid">
    <div class="page-body">
        <div class="container-x1">
            <div class="row row-cards">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-default">
                                <div class="card-header" style="display: flex">
                                    <h3 class="card-title">
                                        {{__('Nota Crédito Ventas')}}
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('credit-note-sales.store') }}" method="post">
                                    @csrf
                                    <div class="row row-cards">
                                    {{--  Buscar Un Numero De Factura  --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="md-3" style="margin-bottom: 16px">
                                                <label for="datos" class="form-label" style="font-weight: bolder">
                                                    {{ __('Venta') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input disabled type="text" name="clients_id" id="clients_id" value="{{$credit_note_sale->sale_id}}" class="form-control">
                                                {!! $errors->first('datos', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                            {{--  Fecha De Elaboracion Nota Credito  --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="md-3" style="margin-bottom: 16px">
                                                <label for="date_credit_notes" class="form-label" style="font-weight: bolder">
                                                    {{ __('Fecha de Creación Nota Credito') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input disabled  type="date" name="date_invoice" id="date_invoice" class="form-control" value="{{$credit_note_sale->date_credit_notes}}">
                                                {!! $errors->first('date_credit_notes', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                        {{--  Cliente  --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="clients_id" class="form-label" style="font-weight: bolder">
                                                    {{ __('Cliente') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input disabled type="text" name="clients_id" id="clients_id" value="{{$credit_note_sale->clients_id}}" class="form-control">
                                                {!! $errors->first('clients_id', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                        {{--  Vendedor --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="sellers" class="form-label" style="font-weight: bolder">
                                                    {{ __('Vendedor') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input disabled type="text" name="sellers" id="sellers" value="{{$credit_note_sale->sellers}}" class="form-control">
                                                {!! $errors->first('sellers', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                        {{--  Metodo de pago --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="payments_methods" class="form-label" style="font-weight: bolder">
                                                    {{ __('Método de Pago')}}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input disabled type="text" name="payments_methods" id="payments_methods" value="{{$credit_note_sale->payments_methods}}" class="form-control">
                                                {!! $errors->first('payments_methods', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                        {{--  Fecha Detalle De Compra  --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="md-3" style="margin-bottom: 16px">
                                                <label for="date_invoice" class="form-label" style="font-weight: bolder">
                                                    {{ __('Fecha de Compra') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input disabled  type="date" name="date_invoice" id="date_invoice" class="form-control" value="{{$credit_note_sale->date_invoice}}">
                                                {!! $errors->first('date_invoice', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                        {{--  Motivo --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="reason" class="form-label" style="font-weight: bolder">
                                                    {{ __('Motivo')}}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input disabled  type="text" name="reason" id="reason" class="form-control" value="{{$credit_note_sale->reason}}">
                                                {!! $errors->first('reason', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                            <br>
                                        </div>
                                        <div class="col-12">
                                        <table id="tablaDetalleVenta" class="table table-hover w-100">
                                            <style>
                                                .bg-dark-blue {
                                                    background-color: #004080; /* Este es el código de color hexadecimal para azul oscuro */
                                                }
                                            </style>
                                            <thead class="bg-dark-blue">
                                                <tr>
                                                    <th>Producto</th>
                                                    <th>Referencia</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio de Venta</th>
                                                    <th>Descuento</th>
                                                    <th>Impuesto</th>
                                                    <th>Subtototal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($credit_note_sale->productos as $item)
                                                <tr>
                                                    <td>
                                                        {{$item->name_product}}
                                                    </td>
                                                    <td>
                                                        {{$item->pivot->references}}
                                                    </td>
                                                    <td>
                                                        {{$item->pivot->amount}}
                                                    </td>
                                                    <td>
                                                        {{$item->pivot->selling_price}}
                                                    </td>
                                                    <td>
                                                        {{$item->pivot->discounts}}
                                                    </td>
                                                    <td>
                                                        {{$item->pivot->tax}}
                                                    </td>
                                                    <td class="td-subtotal">
                                                        {{($item->pivot->amount) * ($item->pivot->selling_price) - ($item->pivot->discounts)}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="8      "></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="6">Sumas:</th>
                                                    <th id="th-suma"><input disabled  type="text"  class="form-control" value="{{$credit_note_sale->gross_totals}}"></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="6">IGV:</th>
                                                    <th id="th-igv">  <input disabled  type="text"  class="form-control" value="{{$credit_note_sale->taxes_total}}"></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="6">Total:</th>
                                                    <th id="th-total"> <input disabled  type="text"  class="form-control" value="{{$credit_note_sale->net_total}}"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <input type="hidden" name="sale_id" id="sale_id">

                                </form>
                            </div>
                            <div class="card-footer text-end">
                                <a class="btn btn-primary" style="margin-right: 2rem" href="{{ route('credit-note-sales.index') }}">Regresar</a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
