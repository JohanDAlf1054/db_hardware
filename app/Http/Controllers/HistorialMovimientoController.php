<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPurchase;
use App\Models\SubCategory;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Sale;

class HistorialMovimientoController extends Controller
{
    public function historialMovimientos(Request $request)
    {
        // Inicializa las variables como colecciones vacías
        $detailPurchases = collect();
        $products = Product::all();
        $ventas = collect();
        $subCategories = SubCategory::all();
        $categories = CategoryProduct::all();
        $estados = ['Activo', 'Inactivo'];
        $resultados = collect();
        $datos = collect(); 
        $fecha_inicio = null;
        $fecha_cierre = null;
    
        return view('reports.historial', compact('resultados', 'detailPurchases', 'products', 'ventas', 'subCategories', 'categories', 'estados', 'fecha_inicio', 'fecha_cierre', 'request', 'datos')); 
        }
    
    public function buscarMovimientos(Request $request)
    {
        $detailPurchases = collect();
        $products = Product::all();
        $ventas = collect();
        $subCategories = SubCategory::all();
        $categories = CategoryProduct::all();
        $estados = ['Activo', 'Inactivo'];
        $resultados = collect();
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_cierre = $request->input('fecha_cierre');
        $subcategoria = $request->input('subcategoria');
        $categoria = $request->input('categoria');
        $producto = $request->input('producto');
        $estado = $request->input('estado');
    
        $status = $request->input('estado');
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_cierre = $request->input('fecha_cierre');
        $producto = $request->input('producto');
        $categoria = $request->input('categoria');
        $subcategoria = $request->input('subcategoria');
    
        // Inicia las variables con todos los datos
        $resultados = DetailPurchase::with('product');
        $ventas = Sale::with('productos');
    
        // Inicializa $detallesCompras
        $detallesCompras = [];
    
        // Llena $detallesCompras con los detalles de las compras de cada producto
        foreach ($products as $product) {
            $detallesCompras[$product->id] = DetailPurchase::where('products_id', $product->id)->get();
        }
    
        // Si se ha enviado el formulario y se ha especificado un estado, filtra por estado
        if ($request->isMethod('post') && !is_null($status)) {
            $resultados = $resultados->whereHas('product', function ($query) use ($status) {
                $query->where('status', $status);
            });
            $ventas = $ventas->whereHas('productos', function ($query) use ($status) {
                $query->where('status', $status);
            });
        }
    
        // Si se ha enviado el formulario y se han especificado una fecha de inicio y una fecha de cierre, filtra por rango de fechas
        if ($request->isMethod('post') && $fecha_inicio && $fecha_cierre) {
            $resultados = $resultados->whereHas('product', function ($query) use ($fecha_inicio, $fecha_cierre) {
                $query->whereBetween('products.created_at', [$fecha_inicio, $fecha_cierre]);
            });
            $ventas = $ventas->whereHas('productos', function ($query) use ($fecha_inicio, $fecha_cierre) {
                $query->whereBetween('products.created_at', [$fecha_inicio, $fecha_cierre]);
            });
        }
    
        // Si se ha enviado el formulario y se ha especificado un producto, filtra por producto
        if ($request->isMethod('post') && $producto) {
            $resultados = $resultados->whereHas('product', function ($query) use ($producto) {
                $query->where('products.id', $producto);
            });
            $ventas = $ventas->whereHas('productos', function ($query) use ($producto) {
                $query->where('products.id', $producto);
            });
        }
    
        // Si se ha enviado el formulario y se ha especificado una categoría, filtra por categoría
        if ($request->isMethod('post') && $categoria) {
            $resultados = $resultados->whereHas('product', function ($query) use ($categoria) {
                $query->where('category_products_id', $categoria);
            });
            $ventas = $ventas->whereHas('productos', function ($query) use ($categoria) {
                $query->where('category_products_id', $categoria);
            });
        }
    
        // Si se ha enviado el formulario y se ha especificado una subcategoría, filtra por subcategoría
        if ($request->isMethod('post') && $subcategoria) {
            $subcategoriaNombre = SubCategory::find($subcategoria)->name;
            $resultados = $resultados->whereHas('product', function ($query) use ($subcategoriaNombre) {
                $query->where('subcategory_product', $subcategoriaNombre);
            });
            $ventas = $ventas->whereHas('productos', function ($query) use ($subcategoriaNombre) {
                $query->where('subcategory_product', $subcategoriaNombre);
            });
        }
    
        $resultados = $resultados->get();
        $ventas = $ventas->get();
    
        // Realiza los cálculos para cada venta
        $datos = [];
        foreach ($ventas as $venta) {
            foreach ($venta->productos as $producto) {
                if (isset($detallesCompras[$producto->id])) {
                    $detalleCompra = $detallesCompras[$producto->id]->shift();
                    $fechaInicial = $producto->created_at->format('Y-m-d H:i:s');
                    $fechaFinal = $venta->created_at->format('Y-m-d H:i:s'); // Fecha en que se vendió el producto
                    $fechaFactura = $detalleCompra ? $detalleCompra->created_at->format('Y-m-d H:i:s'): null; // Fecha en que se realizó la compra
                    $cantidadIngresada = $detalleCompra ? $detalleCompra->quantity_units : 0;
                    $datos[] = [
                        'nombre_del_producto' => $producto->name_product,
                        'referencia_de_fabrica' => $producto->factory_reference,
                        'cantidad_inicial' => '0',
                        'cantidad_entrada' => $cantidadIngresada,
                        'fecha_inicial' => $fechaInicial,
                        'fecha_final' => $fechaFinal,
                        'fecha_de_la_factura' => $fechaFactura,
                        'cantidad_de_salida' => $producto->pivot->amount,
                        'saldo_de_cantidades' => $producto->stock,
                    ];
                }
            }
        }
    
        return view('reports.historial', compact('resultados', 'ventas', 'detailPurchases', 'products', 'ventas', 'subCategories', 'categories', 'estados', 'fecha_inicio', 'fecha_cierre', 'request', 'datos'));
    }
    
public function limpiar(Request $request)
{
    // Inicializa las variables como colecciones vacías
    $detailPurchases = collect();
    $products = Product::all();
    $ventas = collect();
    $subCategories = SubCategory::all();
    $categories = CategoryProduct::all();
    $estados = ['Activo', 'Inactivo'];
    $resultados = collect();
    $fecha_inicio = null;
    $fecha_cierre = null;
    $datos = [];  

    return view('reports.historial', compact('resultados', 'detailPurchases', 'products', 'ventas', 'subCategories', 'categories', 'estados', 'fecha_inicio', 'fecha_cierre', 'request', 'datos'));  
}

}    


