<?php

namespace App\Http\Controllers;

use App\Imports\CategoryImport;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

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
        $request->validate([
            'import_file' => 'required|mimes:xlsx'
        ]);

        try {
            $file = $request->file('import_file');
        
            Excel::import(new CategoryImport, $file, 'xlsx');
            
            return redirect()->route('category.index')->with('success', 'Categorias Agregadas!');
        } catch (\Exception $e){
            return redirect()->route('category.index')->with('error', 'Archivo Incorrecto, el archivo debe ser un archivo Excel (.xlsx)');
        }
    }
}
