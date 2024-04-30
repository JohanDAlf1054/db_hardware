@extends('template')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

<div class="bread_crumb">
    {{ Breadcrumbs::render('credit.note.sales.create') }}
</div>
<br>
@section('content')
<form method="POST" action="{{ route('credit-note-sales.store') }}">
<div class="content container-fluid">
    <div class="page-body">
        <div class="container-x1">
            <div class="row row-cards">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-default">
                                <div class="card-header" style="display: flex">
                                    <h3 class="card-title">
                                        {{__('Nota Credito Ventas')}}
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row row-cards">
                                {{--  Buscar Un Numero De Factura  --}}
                                    <div class="col-sm-6 md-6">
                                        <div class="md-3" style="margin-bottom: 16px">
                                            <label for="sale_id" class="form-label" style="font-weight: bolder">
                                                {{ __('Venta') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="sale_id" id="sale_id" class="form-control selectpicker" data-live-search="true" data-size="3" title="Busque una venta aquí">
                                                @foreach ($sales as $item)
                                                <option value="{{$item->id}}-{{$item->dates}}-{{$item->sellers}}-{{$item->clients_id}}-{{$item->payments_methods}}">{{$item->bill_numbers}}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('sale_id', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>








                                        {{--  Fecha De Elaboracion Nota Credito  --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="md-3" style="margin-bottom: 16px">
                                                <label for="date_credit_notes" class="form-label" style="font-weight: bolder">
                                                    {{ __('Fecha de Creación Nota Credito') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="date" id="date_credit_notes" name="date_credit_notes" value="{{ date('Y-m-d') }}" class="form-control{{ $errors->has('date_invoice') ? ' is-invalid' : '' }}">
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
                                            <input type="text" name="clients_id" id="clients_id" class="form-control">
                                            {!! $errors->first('clients_id', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>

                                        {{--  Motivo --}}
                                        <div class="col-sm-6 md-6">
                                            <div class="mb-3">
                                                <label for="reason" class="form-label" style="font-weight: bolder">
                                                    {{ __('Motivo')}}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select name="reason" id="reason" class="form-control selectpicker" data-live-search="true" data-size="6" title="Motivo ...">
                                                    <option value="Devolucion de parte de los bienes">Devolución de parte de los bienes</option>
                                                    <option value="Anulacion de factura electronica">Anulación de factura electrónica</option>
                                                    <option value="Rebaja o descuento parcial o total">Rebaja o descuento parcial o total</option>
                                                    <option value="Ajuste de precio">Ajuste de precio</option>
                                                    <option value="Otros">Otros</option>
                                                </select>
                                                {!! $errors->first('reason', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>

                                    {{--  Vendedor --}}

                                            <div class="col-sm-6 md-6">
                                                <div class="mb-3">
                                                    <label for="sellers" class="form-label" style="font-weight: bolder">
                                                        {{ __('Vendedor') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="sellers" id="sellers" class="form-control">
                                                    {!! $errors->first('sellers', '<div class="invalid-feedback">:message</div>') !!}
                                                </div>
                                            </div>


                                    {{--  Metodo de pago --}}
                                    <div class="col-sm-6 md-6">
                                        <div class="mb-3">
                                            <label for="payments_methods" class="form-label" style="font-weight: bolder">
                                                {{ __('Metodo de Pago')}}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="payments_methods" id="payments_methods" class="form-control">
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
                                            <input type="date" name="dates" id="dates" class="form-control">
                                            {!! $errors->first('date_invoice', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <table id="tabla_detalle" class="table table-hover w-100">
                                            <style>
                                                .bg-dark-blue {
                                                    background-color: #004080; /* Este es el código de color hexadecimal para azul oscuro */
                                                }
                                            </style>

                                            <thead class="bg-dark-blue">

                                                <tr>
                                                    <th class="text-white">Producto</th>
                                                    <th class="text-white">Referencia</th>
                                                    <th class="text-white">Cantidad</th>
                                                    <th class="text-white">Precio de Venta</th>
                                                    <th class="text-white">Descuento</th>
                                                    <th class="text-white">Impuesto</th>
                                                    <th class="text-white">Subtototal</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($sale->productos as $item)
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
                                                @endforeach --}}
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-md-12 text-end">
                                                <div class="row">
                                                    <div class="col-md-6 text-end">
                                                        <label for="total" class="form-label">Total</label>
                                                    </div>
                                                    <div class="col-md-6 text-end">
                                                        <input type="number" id="total" name="total" value="0" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 text-end">
                                                        <label for="totalBruto" class="form-label">Total Bruto</label>
                                                    </div>
                                                    <div class="col-md-6 text-end">
                                                        <input type="number" id="totalBruto" name="gross_total" value="0" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 text-end">
                                                        <label for="totalNeto" class="form-label">Total Neto</label>
                                                    </div>
                                                    <div class="col-md-6 text-end">
                                                        <input type="number" id="totalNeto" name="totalNeto" value="0" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer text-end">

                                                <a class="btn btn-primary" style="margin-right: 2rem" href="{{ route('credit-note-sales.index') }}">Regresar</a>
                                            {{-- <a class="btn btn-primary" style="margin-right: 5rem" href="{{ route('debit-note-supplier.index') }}">Regresar</a> --}}
                                            <button type="submit" class="btn btn-success">{{ __('Guardar') }}</button>
                                        </div>

                                    </div>
                                </form>

@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<script>
     $(document).ready(function() {

$('#sale_id').change(mostrarValores);


});

function mostrarValores() {
        let dataVenta= document.getElementById('sale_id').value.split('-');
        console.log(dataVenta)
        let fecha = dataVenta.slice(1, 4).join('-'); // Unir los elementos de la fecha con '-'
         console.log(fecha);
        $('#clients_id').val(dataVenta[5]);
        $('#dates').val(fecha);
        $('#sellers').val(dataVenta[4]);
        $('#payments_methods').val(dataVenta[6]);

    }

</script>
@endpush
