<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\SubCategory;
use Illuminate\Http\Request;

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
        $categoryProducts = CategoryProduct::paginate();

        return view('category-product.index', compact('categoryProducts'))
            ->with('i', (request()->input('page', 1) - 1) * $categoryProducts->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryProduct = new CategoryProduct();
        $SubCategory = SubCategory::pluck('name', 'id');
        return view('category-product.create', compact('categoryProduct','SubCategory'));
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
            'name'=>'required|string|max:100',
            'description'=>'required|string|max:100',
            'sub_categories_id'=>'required|string|max:100',
        ];
        $mensaje=[
            'name.required'=>'El nombre de la categoria es requerido',
            'description.required'=>'La descripcion es requerida',
            'sub_categories_id.required'=>'Selecione una Sub Categoria'
        ];

        $this->validate($request, $campos, $mensaje);

        request()->validate(CategoryProduct::$rules);

        $categoryProduct = CategoryProduct::create($request->all());
        // toast('Categoria Creada!','success');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoryProduct = CategoryProduct::find($id);

        return view('category-product.show', compact('categoryProduct'));
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
        $SubCategory = SubCategory::pluck('name', 'id');
        return view('category-product.edit', compact('categoryProduct','SubCategory'));
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
        $campos=[
            'name'=>'required|string|max:100',
            'description'=>'required|string|max:100',
            'sub_categories_id'=>'required|string|max:100',
        ];
        $mensaje=[
            'name.required'=>'El nombre de la categoria es requerido',
            'description.required'=>'La descripcion es requerida',
            'sub_categories_id.required'=>'Selecione una Sub Categoria'
        ];

        $this->validate($request, $campos, $mensaje);

        request()->validate(CategoryProduct::$rules);

        $categoryProduct->update($request->all());
        // toast('Categoria Creada!','success');
        return redirect()->route('category-products.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $categoryProduct = CategoryProduct::find($id)->delete();

        return redirect()->route('category-products.index')
            ->with('success', 'CategoryProduct deleted successfully');
    }
}
