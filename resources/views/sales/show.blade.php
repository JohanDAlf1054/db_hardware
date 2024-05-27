@auth
@can('sales')

<div class="bread_crumb">
    {{ Breadcrumbs::render('sales.show', $sale) }}
</div>
<br>

@extends('template')

@section('title','Ver venta')

@section('content')

@push('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush
<div class="container-fluid">

    <div class="card mb-4">

        <div class="card-header">
            Datos generales de la venta
        </div>

        <div class="card-body">
     <!---Numero comprobante--->
     <div class="row mb-4">
        <div class="col-sm-6">
            <div class="input-group" id="hide-group">
                <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                <input disabled type="text" class="form-control" value="Número de comprobante: ">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group">
                <span title="Número de comprobante" id="icon-form" class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                <input disabled type="text" class="form-control" value="{{$sale->bill_numbers}}">
            </div>
        </div>
    </div>

    <!---Cliente--->
    <div class="row mb-4">
        <div class="col-sm-6">
            <div class="input-group" id="hide-group">
                <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
                <input disabled type="text" class="form-control" value="Cliente: ">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group">
                <span title="Cliente" class="input-group-text" id="icon-form"><i class="fa-solid fa-user-tie"></i></span>
                <input disabled type="text" class="form-control" value="{{$sale->cliente->identification_number}}">
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-sm-6">
            <div class="input-group" id="hide-group">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <input disabled type="text" class="form-control" value="Vendedor: ">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group">
                <span title="Vendedor" class="input-group-text" id="icon-form"><i class="fa-solid fa-user"></i></span>
                <input disabled type="text" class="form-control" value="{{$sale->sellers}}">
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-sm-6">
            <div class="input-group" id="hide-group">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                <input disabled type="text" class="form-control" value="Fecha: ">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group">
                <span title="Fecha" class="input-group-text" id="icon-form"><i class="fa-solid fa-calendar-days"></i></span>
                <input disabled type="text" class="form-control" value="{{ \Carbon\Carbon::parse($sale->fecha_hora)->format('d-m-Y') }}">
            </div>
        </div>
    </div>

        <div class="col-sm-6">
            <div class="input-group">
                <input type="hidden"   id="input-impuesto" disabled type="text" class="form-control" value="{{ $sale->taxes_total }}">
            </div>

        </div>
    </div>
</div>
</div>
    <!---Tabla--->
    <div class="card mb-2">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla de detalle de la venta
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead class="bg-primary text-white">
                    <tr class="align-top">
                        <th>Producto</th>
                        <th>Referencia</th>
                        <th>Cantidad</th>
                        <th>Precio de venta</th>
                        <th>Descuento</th>
                        <th>Impuesto</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sale->productos as $item)
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
                        <th colspan="7"></th>
                    </tr>
                    <tr>
                        <th colspan="6">Sumas:</th>
                        <th id="th-suma"></th>
                    </tr>
                    <tr>
                        <th colspan="6">IGV:</th>
                        <th id="th-igv"></th>
                    </tr>
                    <tr>
                        <th colspan="6">Total:</th>
                        <th id="th-total"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="card-footer text-end">
        <a class="btn btn-primary" style="margin-right: 2rem" href="{{ route('sales.index') }}">Regresar</a>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        calcularValores();
    });

    function calcularValores() {
        let filasSubtotal = document.getElementsByClassName('td-subtotal');
        let cont = 0;
        let impuesto = parseFloat($('#input-impuesto').val());

        for (let i = 0; i < filasSubtotal.length; i++) {
            cont += parseFloat(filasSubtotal[i].innerHTML);
        }

        let sumaRedondeada = round(cont);
        let totalRedondeado = round(cont + impuesto);

        $('#th-suma').html(sumaRedondeada.toFixed(2));
        $('#th-igv').html(impuesto.toFixed(2));
        $('#th-total').html(totalRedondeado.toFixed(2));
    }

    function round(num, decimales = 2) {
        return Math.round(num * Math.pow(10, decimales)) / Math.pow(10, decimales);
    }
</script>
@endpush
@else
    <div class="mensaje_Rol">
        <img src="{{ asset('img/Rol_no_asignado.png')}}" class="img_rol"/>
        <h2 class="texto_noRol">Pídele al administrador que se te asigne un rol.</h2>
    </div>
@endcan
@endauth
@guest
    @include('include.falta_sesion')
@endguest
