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

        return redirect()->route('category-products.index')
            ->with('success', 'CategoryProduct deleted successfully');
    }
}
