<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

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
    public function index()
    {
        $subCategories = SubCategory::paginate();

        return view('sub-category.index', compact('subCategories'))
            ->with('i', (request()->input('page', 1) - 1) * $subCategories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subCategory = new SubCategory();
        return view('sub-category.create', compact('subCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(SubCategory::$rules);

        $subCategory = SubCategory::create($request->all());

        return redirect()->route('sub-categories.index')
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
    public function update(Request $request, SubCategory $subCategory)
    {
        request()->validate(SubCategory::$rules);

        $subCategory->update($request->all());

        return redirect()->route('sub-categories.index')
            ->with('success', 'SubCategory updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $subCategory = SubCategory::find($id)->delete();

        return redirect()->route('sub-categories.index')
            ->with('success', 'SubCategory deleted successfully');
    }
}
