<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CategoryProduct;
use App\Models\MeasurementUnit;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
Use Illuminate\Support\Facades\Session;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filtervalue = $request->input('filtervalue');
        $activeCheck = $request->input('check');
        $categoryId = $request->input('category_filter');
        
        $productos = Product::query()
            ->when($filtervalue, function($query) use ($filtervalue) {
                return $query->where('name_product','like','%'.$filtervalue.'%')
                ->orWhere('description_long','like','%'.$filtervalue.'%')
                ->orWhere('factory_reference','like','%'.$filtervalue.'%')
                ->orWhere('classification_tax',$filtervalue)
                ->orWhereHas('brand', function($query) use ($filtervalue){
                    if($filtervalue){
                        return $query->where('name',$filtervalue);
                    }
                })
                ->orWhereHas('measurementUnit', function($query) use ($filtervalue){
                    if($filtervalue){
                        return $query->where('name','like','%'.$filtervalue.'%');
                    }
                });
            })
            ->when($categoryId, function($query) use ($categoryId) {
                return $query->where('category_products_id', $categoryId);
            })
            ->when($activeCheck, function($query) use ($activeCheck) {
                return $query->where('status', true);
            })
            ->paginate(5); 

            $categories = CategoryProduct::all();
            // $productos = Product::query() 
            // ->when($categoryId, function($query) use ($categoryId) {
            //     return $query->where('category_products_id', $categoryId);
            // })->paginate(5); 

            //filtrar los productos activos
            // $productos = Product::query() 
            // ->when($activeCheck, function($query) {
            //     return $query->where('status', True);
            // })->paginate(5);

        return view('product.index', compact('productos', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto = new Product();
        $categorias = CategoryProduct::pluck('name','id');
        $marcas = Brand::pluck('name','id');
        $unidades = MeasurementUnit::pluck('name','id');
        return view('product.create', compact('producto', 'categorias','marcas','unidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[
            'name_product'=>'required|string|max:100|unique:products,name_product',
            'description_long'=>'required|string|max:100',
            'factory_reference'=>'required|string|max:100',
            'classification_tax'=>'required|string|max:100',
            'selling_price' => 'required|numeric|greater_than_zero',
            'category_products_id'=>'required|max:100',
            'brands_id'=>'required|max:100',
            'measurement_units_id'=>'required|max:100',
            'photo'=>'nullable|max:10000|mimes:jpg,png,jpeg',
        ];
        $mensaje=[
            'name_product.required'=>'Escriba el nombre del producto',
            'name_product.unique'=>'Este producto ya existe!',
            'description_long.required'=>'Escriba una breve descripción',
            'factory_reference.required'=>'Escriba la referencia del producto',
            'classification_tax.required'=>'Selecione la clasificacion',
            'selling_price.required' => 'Escriba el precio de venta',
            'selling_price.numeric' => 'El precio de venta debe ser numérico',
            'selling_price.greater_than_zero' => 'El precio de venta debe ser mayor a 0',
            'category_products_id.required'=>'Selecione la categoria',
            'brands_id.required'=>'Selecione la marca',
            'measurement_units_id.required'=>'Selecione la unidad de medida',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosProducto = request()->except('_token');

        if($request->hasFile('photo')){
            $datosProducto['photo']=$request->file('photo')->store('products','public');
        }
        Product::create($datosProducto);
        // toast('Producto Creado!','success');
        Session::flash('notificacion', [
            'tipo' => 'exito',
            'titulo' => 'Éxito!',
            'descripcion' => 'El producto se ha creado.',
            'autoCierre' => 'true'
        ]);
        return redirect('products');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Product::find($id);

        return view('product.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Product::find($id);
        $categorias = CategoryProduct::pluck('name','id');
        $marcas = Brand::pluck('name','id');
        $unidades = MeasurementUnit::pluck('name','id');

        return view('product.edit', compact('producto','categorias','marcas','unidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'name_product'=>'required|string|max:100|unique:products,name_product',
            'description_long'=>'required|string|max:100',
            'factory_reference'=>'required|string|max:100',
            'classification_tax'=>'required|string|max:100',
            'selling_price' => 'required|numeric|greater_than_zero',
            'category_products_id'=>'required|max:100',
            'brands_id'=>'required|max:100',
            'measurement_units_id'=>'required|max:100',
            'photo'=>'nullable|max:10000|mimes:jpg,png,jpeg',
        ];
        $mensaje=[
            'name_product.required'=>'Escriba el nombre del producto',
            'name_product.unique'=>'Este producto ya existe!',
            'description_long.required'=>'Escriba una breve descripción',
            'factory_reference.required'=>'Escriba la referencia del producto',
            'classification_tax.required'=>'Selecione la clasificacion',
            'selling_price.required' => 'Escriba el precio de venta',
            'selling_price.numeric' => 'El precio de venta debe ser numérico',
            'selling_price.greater_than_zero' => 'El precio de venta debe ser mayor a 0',
            'category_products_id.required'=>'Selecione la categoria',
            'brands_id.required'=>'Selecione la marca',
            'measurement_units_id.required'=>'Selecione la unidad de medida',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosProducto=request()->except(['_token','_method']);

        if ($request->hasFile('photo')) {
            $producto = Product::findOrFail($id);
            Storage::delete('public/'.$producto->photo);
            $datosProducto['photo']=$request->file('photo')->store('products','public');
        }
        
        Product::where('id','=',$id)->update($datosProducto);
        // toast('Producto Modificado!','success');
        return redirect('products')->with('success', 'Producto Modificado!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $producto = Product::find($id);
        if ($producto->status == 1) {
            Product::where('id', $producto->id)
            ->update([
                'status' => 0
            ]);
        } else {
            Product::where('id', $producto->id)
            ->update([
                'status' => 1
            ]);
        }
        return redirect()->route('products.index')->with('success', 'Actualización estado Producto!');
    }
}
