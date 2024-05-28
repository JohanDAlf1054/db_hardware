<?php

namespace App\Http\Controllers;

use App\Imports\CategoryImport;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
/**
 * Class CategoryProductController
 * @package App\Http\Controllers
 */
class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categoryProducts = CategoryProduct::paginate();

        // return view('category-product.index', compact('categoryProducts'))
        //     ->with('i', (request()->input('page', 1) - 1) * $categoryProducts->perPage());
        return view('category-product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryProduct = new CategoryProduct();
        return view('category-product.create', compact('categoryProduct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(CategoryProduct::$rules);

        $categoryProduct = CategoryProduct::create($request->all());

        return redirect()->route('category.index')
            ->with('success', 'CategoryProduct created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Session::put("category_id", $id);
        return redirect()->route('categorySub.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryProduct = CategoryProduct::find($id);

        return view('category-product.edit', compact('categoryProduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  CategoryProduct $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryProduct $categoryProduct)
    {
        request()->validate(CategoryProduct::$rules);

        $categoryProduct->update($request->all());

        return redirect()->route('category-products.index')
            ->with('success', 'CategoryProduct updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $categoryProduct = CategoryProduct::find($id)->delete();

        return redirect()->route('category.index')
            ->with('success', 'CategoryProduct deleted successfully');
    }

    public function importCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'import_file' => 'required|mimes:xlsx'
        ]);

        if ($validator->fails()) {
            Session::flash('notificacion', [
                'tipo' => 'error',
                'titulo' => 'Error!',
                'descripcion' => 'Archivo incorrecto, debe de ser de extensión xlsx.',
                'autoCierre' => 'true'
            ]);
            return redirect()->route('category.index');
        }
        try {
            $file = $request->file('import_file');

            Excel::import(new CategoryImport, $file, 'xlsx');
            Session::flash('notificacion', [
                'tipo' => 'exito',
                'titulo' => 'Éxito!',
                'descripcion' => 'Categorías Agregadas Correctamente!',
                'autoCierre' => 'true'
            ]);
            return redirect()->route('category.index');
        }catch (\Exception $e){
        }
    }

    public function subCategories(categoryProduct $categoryProduct)
    {
        return response()->json($categoryProduct->subCategories);
    }

    public function subCategoriesEdit($id, $category)
    {
        $producto = Product::find($id);
        $category = CategoryProduct::find($category); // Asumiendo que hay una relación en tu modelo Product
        $subCategories = $category->subCategories;
        return response()->json($subCategories);
    }
}
