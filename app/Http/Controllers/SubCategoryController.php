<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Class SubCategoryController
 * @package App\Http\Controllers
 */
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAll()
    {
        $subCategories = SubCategory::all();

        return view('sub-category.indexAll', compact('subCategories'));
    }

    public function index()
    {
        $subCategories = SubCategory::where('category_id', Session::get("category_id") )->get();

        return view('sub-category.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subCategory = new SubCategory();
        return view('sub-category.create' , compact('subCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = [
                'name' => 'required|string|max:100|unique:sub_categories,name,',
                'description' => 'required|max:100',
        ];
        $mensaje = [
            'name.required'=>'Escriba el nombre de la Sub categoria',
            'name.unique'=>'Esta Sub Categoria ya existte!',
            'description.required'=>'Escriba una breve descripción',
        ];
        $this->validate($request, $campos, $mensaje);
        $subCategory = new SubCategory($request->all());
        $subCategory->category_id = Session::get("category_id");
        $subCategory->save();
         return redirect()->route('categorySub.index')
            ->with('success', 'SubCategory created successfully.');

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subCategory = SubCategory::find($id);

        return view('sub-category.show', compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subCategory = SubCategory::find($id);

        return view('sub-category.edit', compact('subCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SubCategory $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory, $id)
    {
        $campos = [
            'name' => 'required|string|max:100|unique:sub_categories,name,',
            'description' => 'required|max:100',
    ];
    $mensaje = [
        'name.required'=>'Escriba el nombre de la Sub categoria',
        'name.unique'=>'Esta Sub Categoria ya existte!',
        'description.required'=>'Escriba una breve descripción',
    ];
        $this->validate($request, $campos, $mensaje);
        $subCategory = SubCategory::find($id);
        $subCategory->update($request->all());
        $subCategory->save();
        return redirect()->route('categorySub.index')
            ->with('success', 'SubCategory updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $subCategory = SubCategory::find($id);
        $subCategory->delete();

        return redirect()->route('categorySub.index')
            ->with('success', 'SubCategory deleted successfully');
    }
}
