<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CategoryProduct;
use App\Models\MeasurementUnit;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        
        $productos = Product::query()
            ->when($filtervalue, function($query) use ($filtervalue) {
                return $query->where('name_product','like','%'.$filtervalue.'%');
            })
            ->orWhere('description_long','like','%'.$filtervalue.'%')
            ->orWhere('factory_reference','like','%'.$filtervalue.'%')
            ->orWhere('status',$filtervalue)
            ->orWhere('classification_tax',$filtervalue)
            ->orWhereHas('categoryProduct', function($query) use ($filtervalue){
                if($filtervalue){
                    return $query->where('name',$filtervalue);
                }
            })
            ->orWhereHas('brand', function($query) use ($filtervalue){
                if($filtervalue){
                    return $query->where('name',$filtervalue);
                }
            })
            ->orWhereHas('measurementUnit', function($query) use ($filtervalue){
                if($filtervalue){
                    return $query->where('name',$filtervalue);
                }
            })->paginate(3);   
        // $productFilter = Producto::where('nombre','like','%'.$filtervalue.'%');

        // $productos = $productFilter->paginate(2);
        return view('product.index',[
            'productos' => $productos,
        ])->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
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
            'name_product'=>'required|string|max:100',
            'description_long'=>'required|string|max:100',
            'factory_reference'=>'required|string|max:100',
            'factory_reference'=>'required|string|max:100',
            'status'=>'required|string|max:100',
            'stock'=>'required|max:100',
            'category_products_id'=>'required|max:100',
            'brands_id'=>'required|max:100',
            'measurement_units_id'=>'required|max:100',
            'photo'=>'required|max:10000|mimes:jpg,png,jpeg',
        ];
        $mensaje=[
            'required'=>'Los :attribute son requeridos',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosProducto = request()->except('_token');

        if($request->hasFile('photo')){
            $datosProducto['photo']=$request->file('photo')->store('products','public');
        }
        Product::create($datosProducto);
        return redirect('products')->with('mensaje','Proveedor agregado con éxito' );
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
            'nombre'=>'required|string|max:100',
        ];
        if ($request->hasFile('photo')) {
            $campos=['photo'=>'nullable|max:10000|mimes:jpg,png,jpeg'];
        }

        $mensaje=[
            'required'=>'Los :attribute son requeridos',
        ];

        $this->validate($request, $campos, $mensaje);

        $datosProducto=request()->except(['_token','_method']);

        if ($request->hasFile('foto')) {
            $producto = Product::findOrFail($id);
            Storage::delete('public/'.$producto->photo);
            $datosProducto['photo']=$request->file('photo')->store('products','public');
        }

        // if ($request->hasFile('foto')) {
        //     File::delete(public_path('storage/'. $producto->foto ));
        //     $foto = $request['foto']->store('products','public');
        // }else{
        //     $foto = $producto->foto;
        // }

        // $producto->foto = $foto;
        
        Product::where('id','=',$id)->update($datosProducto);

        return redirect('products')->with('mensaje','Producto Modificado' );
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $producto = Product::find($id)->delete();

        return redirect()->route('products.index')
            ->with('success', 'Producto deleted successfully');
    }
}
