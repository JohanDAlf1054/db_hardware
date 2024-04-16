@extends('template')

@section('title','Ver venta')

@section('content')

@push('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush
<div class="container-fluid">
        <div class="col-sm-6">
            <div class="input-group">
                <input type="hidden"   id="input-impuesto" disabled type="text" class="form-control" value="{{ $sale->taxes_total }}">
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
                        <th class="text-white">Producto</th>
                        <th class="text-white">Referencia</th>
                        <th class="text-white">Cantidad</th>
                        <th class="text-white">Precio de venta</th>
                        <th class="text-white">Descuento</th>
                        <th class="text-white">Impuesto</th>
                        <th class="text-white">Subtotal</th>
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
                        <th colspan="5"></th>
                    </tr>
                    <tr>
                        <th colspan="4">Sumas:</th>
                        <th id="th-suma"></th>
                    </tr>
                    <tr>
                        <th colspan="4">IGV:</th>
                        <th id="th-igv"></th>
                    </tr>
                    <tr>
                        <th colspan="4">Total:</th>
                        <th id="th-total"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
@endsection

@push('js')
<script>
    //Variables
    let filasSubtotal = document.getElementsByClassName('td-subtotal');
    let cont = 0;
    let impuesto = $('#input-impuesto').val();

    $(document).ready(function() {
        calcularValores();
    });

    function calcularValores() {
        for (let i = 0; i < filasSubtotal.length; i++) {
            cont += parseFloat(filasSubtotal[i].innerHTML);
        }

        $('#th-suma').html(cont);
        $('#th-igv').html(impuesto);
        $('#th-total').html(round(cont + parseFloat(impuesto)));
    }

    function round(num, decimales = 2) {
        var signo = (num >= 0 ? 1 : -1);
        num = num * signo;
        if (decimales === 0) //con 0 decimales
            return signo * Math.round(num);
        // round(x * 10 ^ decimales)
        num = num.toString().split('e');
        num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
        // x * 10 ^ (-decimales)
        num = num.toString().split('e');
        return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
    }
    //Fuente: https://es.stackoverflow.com/questions/48958/redondear-a-dos-decimales-cuando-sea-necesario
</script>
@endpush