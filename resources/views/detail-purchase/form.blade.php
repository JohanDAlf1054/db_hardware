@auth
@can('detail-purchases')
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

</head>
<body>
<div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">
        </ul> 
    </div>
    </nav>
    <div class="container">
        <form action="{{ route('detail-purchases.store') }}" method="POST">
        @csrf
        <div class="row">
        <div class="container-lg mt-4">
        <div class="row gy-4">
            <!------Compra producto---->
            <div class="col-xl-8">
                <div class="text-white bg-primary p-1 text-center">
                    Detalles de la compra
                </div>
                <div class="p-3 border border-3 border-primary">
                    <div class="row">
                        
                        <div class="col-12 mb-4">
                            <label for="producto_id" class="form-label">Producto:</label>
                            <select name="producto_id" id="producto_id" class="form-control selectpicker {{ $errors->has('producto_id') ? ' is-invalid' : '' }}" data-live-search="true" data-size="5" title="Seleccione un producto">
                                <option value="">Seleccione un producto</option>
                                @foreach ($products as $item)
                                    <option value="{{ $item->id }}" data-purchase-price="{{ $item->purchase_price }}" data-classification-tax="{{ $item->classification_tax }}" {{ old('producto_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name_product }}
                                    </option>
                                @endforeach
                            </select>
                            {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
                     </div>
                        
                        {{--
                        <div class="col-6 mb-2">
                            <label for="identification_type" class="form-label">Tipo de identificación:</label>
                            <input type="text" id="identification_type" name="identification_type" class="form-control" value="{{ old('identification_type', isset($detailPurchase) && isset($detailPurchase->purchaseSupplier) && isset($detailPurchase->purchaseSupplier->person) ? $detailPurchase->purchaseSupplier->person->identification_type : '') }}">
                            @error('identification_type')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-6 mb-2">
                            <label for="identification_number" class="form-label">Número de identificación:</label>
                            <input type="text" id="identification_number" name="document_number" required class="form-control" value="{{ old('document_number', isset($detailPurchase) && isset($detailPurchase->purchaseSupplier) && isset($detailPurchase->purchaseSupplier->person) ? $detailPurchase->purchaseSupplier->person->identification_number : '') }}">
                            @error('identification_number')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>
                        --}}
                      {{--<div class="col-6 mb-4">
                            <label for="fecha" class="form-label">Fecha de Compra:</label>
                            <input type="date" id="fecha" name="fecha" class="form-control" value="{{ old('date_purchase', isset($detailPurchase) ? $detailPurchase->date_purchase : '') }}">
                            @error('fecha')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>--}}  
                        <div class="col-sm-4 mb-2">
                            <label for="precio_compra" class="form-label">Precio Unitario:</label>
                            <input type="number" name="precio_compra" id="precio_compra" class="form-control" step="0.1">
                        </div>
                        <br>
                        
                        <div class="col-sm-4 mb-2">
                            <label for="cantidad" class="form-label">Cantidad:</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control">
                        </div>
                        

                        
                        
                        <div class="col-sm-4 mb-2">
                            <label for="precio_venta" class="form-label"> Descripción:</label>
                            <input type="text" name="precio_venta" id="precio_venta" class="form-control" step="0.1">
                        </div>

                        <div class="col-6 mb-2">
                            <label for="discount_total" class="form-label">Descuento Total</label>
                            <input type="number" id="discount_total" name="discount_total" min="0" max="100" step="1" class="form-control" placeholder="Ingrese el porcentaje de descuento" oninput="this.value = Math.round(this.value)" value="{{ old('discount_total', isset($detailPurchase) ? $detailPurchase->discount_total : '') }}">
                            @error('discount_total')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>

                        <div class="col-6 mb-4">
                            <label for="product_tax" class="form-label">Impuesto a cargo del producto</label>
                            <select id="product_tax" name="product_tax" class="form-control">
                                <option value="0" {{ old('product_tax', isset($detailPurchase) ? $detailPurchase->product_tax : '') == 0 ? 'selected' : '' }}>0%</option>
                                <option value="5" {{ old('product_tax', isset($detailPurchase) ? $detailPurchase->product_tax : '') == 5 ? 'selected' : '' }}>5%</option>
                                <option value="19" {{ old('product_tax', isset($detailPurchase) ? $detailPurchase->product_tax : '') == 19 ? 'selected' : '' }}>19%</option>
                            </select>
                            
                            @error('product_tax')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>
                        <div class="col-12 mb-4 mt-2 text-end">
                            <button id="btn_agregar" class="btn btn-primary" type="button">Agregar</button>
                        </div>
                        
                        
                        
                        
                    
                    
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="tabla_detalle" class="table table-hover">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Descripcion</th>
                                            <th>Impuesto</th>
                                            <th>Descuento</th>
                                            <th>Precio Unitario</th>
                                            <th>Sub Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">Sumas</th>
                                            <th colspan="2"><span id="sumas">0</span></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">IGV %</th>
                                            <th colspan="2"><span id="igv">0</span></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">Total</th>
                                            <th colspan="2"><input type="hidden"name="total" value="0" id="inputTotal"><span id="total">0</span></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">Total Bruto</th>
                                            <th colspan="2"><input type="hidden" name="totalBruto" id="hiddenTotalBruto"><span id="totalBruto"> 
                                                0</span></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">Total Neto</th>
                                            <th colspan="2"><input type="hidden" name="totalNeto" id="hiddenTotalNeto"> <span id="totalNeto">0</span></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                                
                        <div class="col-12 mt-2">
                            <button id="cancelar" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Cancelar compra
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-----Compra---->
            <div class="col-xl-4">
                <div class="text-white bg-success p-1 text-center">
                    Datos generales
                </div>
                <div class="p-3 border border-3 border-success">
                    <div class="row">
                        <!--Proveedor-->
                        <div class="col-12">
                            <label for="people_id" class="form-label">Proveedor:</label>
                            <select name="people_id" id="people_id"  class="form-control selectpicker show-tick" data-live-search="true" title="Selecciona el cliente" data-size='3'>
                                @foreach ($people as $person)
                                <option value="{{$person->id}}">{{$person->identification_number}} - {{$person->first_name}} {{$person->other_name}} {{$person->surname}} {{$person->second_surname}} {{$person->company_name}}</option>
                                @endforeach
                            </select>
                            @error('people_id')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>
                    
                        <div class="col-6 mb-2">
                            <label for="user_id" class="form-label">Empleado:</label>
                            <select name="user_id" id="user_id" class="form-control selectpicker show-tick" data-live-search="true" title="Selecciona" data-size='2'>
                                <option value="">Seleccione un Empleado</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">
                                        {{$user->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>
                        
                        
                        
                        <!--Impuesto---->
                            <div class="col-sm-6 mb-2">
                                <label for="fecha" class="form-label">Fecha:</label>
                                <input readonly type="date" name="fecha" id="fecha" class="form-control border-success" value="<?php echo date("Y-m-d") ?>">
                            </div>
                            <div class="col-6 mb-2">
                                <label for="code" class="form-label">Prefijo:</label>
                                <div class="input-group">
                                    <select name="code" id="code" class="form-control selectpicker">
                                        <option value="Pre-">Pre</option>
                                        <option value="Po-">Po</option>
                                        <option value="Es-">Es</option>
                                    </select>
                                </div>
                                @error('code')
                                <small class="text-danger">{{ '*'.$message }}</small>
                                @enderror
                            </div>
                            <div class="col-6 mb-2">
                                <label for="invoice_number_purchase" class="form-label">Número de factura</label>
                                <input type="text" id="invoice_number_purchase" name="invoice_number_purchase" class="form-control {{ $errors->has('invoice_number_purchase') ? ' is-invalid' : '' }}" placeholder="Ingrese el número de factura" value="{{ old('invoice_number_purchase', isset($purchaseSupplier) ? $purchaseSupplier->invoice_number_purchase : '') }}">
                                @error('invoice_number_purchase')
                                <small class="text-danger">{{ '*'.$message }}</small>
                                @enderror
                            </div>
                            
                            
                            
                                <div class="col-6 mb-2">
                                
                                    <label for="form_of_payment" class="form-label">Formas de pago:</label>
                                    <select id="form_of_payment" name="form_of_payment" class="form-control">
                                        
                                        <option value="tarjeta" {{ old('form_of_payment', isset($detailPurchase) ? $detailPurchase->form_of_payment : '') == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                                        <option value="efectivo" {{ old('form_of_payment', isset($detailPurchase) ? $detailPurchase->form_of_payment : '') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                                    </select>
                                    @error('form_of_payment')
                                    <small class="text-danger">{{ '*'.$message }}</small>
                                    @enderror
                                </div>
                                
                                <div class="col-6 mb-2">
                                    <label for="method_of_payment" class="form-label">Método de Pago:</label>
                                    <select id="method_of_payment" name="method_of_payment" class="form-control">
                                    
                                        <option value="cuotas">Cuotas</option>
                                        <option value="contado">Contado</option>
                                    </select>
                                    @error('method_of_payment')
                                    <small class="text-danger">{{ '*'.$message }}</small>
                                    @enderror
                                </div>
                                
                                <div class="col-12 mt-4 text-center">
                                    <button type="submit" class="btn btn-success" id="guardar">Realizar compra</button>
                                </div>
        
                            </div>
                        </div>
                    </div>
        </div>
        </div>
        </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="examplebtnModalLabel">Advertencia</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Seguro que quieres cancelar la compra?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button id="btnCancelarCompra" type="button" class="btn btn-danger" data-bs-dismiss="modal">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
        {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script> 

        
        <script>
            $(document).ready(function(){
    $('#btn_agregar').click(function(){
        agregarProducto();
    });
    
    $('#btnCancelarCompra').click(function() {
            cancelarCompra();
        });
        disableButtons();
});

let cont=0;
let subtotal=[];
let sumas=0;
let igv=0;
let total=0;
let totalBruto=0;
let totalNeto = 0; 
function cancelarCompra() {
        $('#tabla_detalle tbody').empty();
        let fila = '<tr>' +
            '<th></th>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '</tr>';
        $('#tabla_detalle').append(fila);
cont=0;
subtotal=[];
sumas=0;
igv=0;
total=0;
totalBruto=0;
totalNeto = 0; 

$('#sumas').html(sumas);
    $('#igv').html(igv);
    $('#total').html(total);
    $('#totalBruto').html(totalBruto);
    $('#totalNeto').html(totalNeto);
    $('#inputTotal').val(total);
    $('#hiddenTotalBruto').val(totalBruto);
    $('#hiddenTotalNeto').val(totalNeto);

   
limpiarCampos();
disableButtons();
}
function disableButtons() {
        if (total == 0) {
            $('#guardar').hide();
        } else {
            $('#guardar').show();
        }
    }


function agregarProducto(){
    let idProducto = $('#producto_id').val();
    let nameProducto = $('#producto_id option:selected').text();
    let cantidad=$('#cantidad').val();
    let descripcion=$('#precio_venta').val();
    let impuesto=$('#product_tax').val();
    let precioCompra=$('#precio_compra').val();
    let descuentoProducto=$('#discount_total').val();
    
if (idProducto === '' || idProducto === undefined || nameProducto === '' || nameProducto === undefined || cantidad === '' || cantidad === undefined || descripcion === '' || descripcion === undefined || impuesto === '' || impuesto === undefined || precioCompra === '' || precioCompra === undefined || descuentoProducto === '' || descuentoProducto === undefined) {
    showModal('Le faltan campos por llenar');
} else if (!(parseInt(cantidad) > 0 && (cantidad % 1 === 0) && parseFloat(precioCompra) > 0)) {
    showModal('Valores incorrectos');
} else if (descuentoProducto > cantidad * precioCompra) {
    showModal('El descuento no puede ser mayor que el valor de la compra');
} else {
    subtotal[cont] = Math.round(cantidad * precioCompra * 100) / 100;
sumas += subtotal[cont];
igv = Math.round(sumas * impuesto / 100 * 100) / 100; 
total = sumas + igv;
totalBruto = sumas;
totalNeto = Math.round((totalBruto - descuentoProducto) * 100) / 100;



$('#gross_total').val(totalBruto);

       

        let fila = '<tr id="fila' + cont + '">' +
    '<th>' + (cont+1) + '</th>' +
    '<td><input type="hidden" name="arrayidproducto[]" value="' + idProducto + '">' + nameProducto + '</td>' +
    '<td><input type="hidden" name="arraycantidad[]" value="' + cantidad + '">' + cantidad + '</td>' +
    '<td><input type="hidden" name="arrayprecioventa[]" value="' + descripcion + '">' + descripcion + '</td>' +
    '<td><input type="hidden" name="arrayimpuesto[]" value="' + impuesto + '">' + impuesto + '</td>' +
    '<td><input type="hidden" name="arraydescuento[]" value="' + descuentoProducto + '">' + descuentoProducto + '</td>' +
    '<td><input type="hidden" name="arraypreciocompra[]" value="' + precioCompra + '">' + precioCompra + '</td>' +

    '<td>' + subtotal[cont] + '</td>' +
    '<td><button class="btn btn-danger" type="button" onClick="eliminarProducto(' + cont + ', ' + impuesto + ')"><i class="fa-solid fa-trash"></i></button></td>' +
    '</tr>';

        $('#tabla_detalle').append(fila);
        limpiarCampos();
        cont++;
        disableButtons();
        $('#sumas').html(sumas);
        $('#igv').html(igv);
        $('#total').html(total);
        $('#totalBruto').html(totalBruto);
        $('#totalNeto').html(totalNeto);
        $('#inputTotal').val(total);
        $('#hiddenTotalBruto').val(totalBruto);
        $('#hiddenTotalNeto').val(totalNeto);
    }

}

function eliminarProducto(indice, impuesto) {
    sumas -= round(subtotal[indice]);
    igv = round(sumas / 100 * impuesto);
    total = round(sumas + igv);
    totalBruto = round(sumas);
    totalNeto = total;

    //Mostrar los campos calculados
    $('#sumas').html(sumas);
    $('#igv').html(igv);
    $('#total').html(total);
    $('#totalBruto').html(totalBruto);
    $('#totalNeto').html(totalNeto);
    $('#inputTotal').val(total);
    $('#hiddenTotalBruto').val(totalBruto);
    $('#hiddenTotalNeto').val(totalNeto);
    //Eliminar el fila de la tabla
    $('#fila'+indice).remove();
}

function limpiarCampos() {
    let select = $('#producto_id');
        select.selectpicker('val', '');
    $('#cantidad').val('');
    $('#precio_venta').val('');
    $('#product_tax').val('');
    $('#precio_compra').val('');
    $('#discount_total').val('');
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
    function showModal(message, icon = 'error') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: icon,
            title: message
        })
    }
        </script>
     {{-- /*   <script>
            document.getElementById('factura').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var date = selectedOption.getAttribute('data-date');
            document.getElementById('fecha').value = date;
            });
        </script>--}}
        <script>
            document.getElementById('producto_id').addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var purchasePrice = selectedOption.getAttribute('data-purchase-price');
                var classificationTax = Number(selectedOption.getAttribute('data-classification-tax').replace('%', ''));
        
                if (isNaN(classificationTax)) {
                    console.log('classification_tax no es un número');
                } else {
                    console.log('classification_tax es un número:', classificationTax);
                }
        
                document.getElementById('precio_compra').value = purchasePrice;
        
                var productTaxSelect = document.getElementById('product_tax');
                for (var i = 0; i < productTaxSelect.options.length; i++) {
                    if (Number(productTaxSelect.options[i].value) === classificationTax) {
                        productTaxSelect.options[i].selected = true;
                        break;
                    }
                }
            });
        </script> 
    @endcan
@endauth
@guest
    @include('include.falta_sesion')
@endguest
