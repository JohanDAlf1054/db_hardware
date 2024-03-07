<?php

namespace App\Livewire;

use App\Models\CategoryProduct;
use App\Models\SubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriesComponent extends Component
{
    use WithPagination;
    public $search='';
    public $Id, $name, $description, $subCategory, $otherModelData;

    public function render()
    {   
        $categories = CategoryProduct::where('name','like', '%'.$this->search.'%')->paginate(5);
        return view('livewire.categories-component', compact('categories'));
    }

    public function store(){
        $category = SubCategory::findOrFail($this->subCategory);

        $categories = New CategoryProduct();
        $categories->name = $this -> name;
        $categories->description = $this -> description;
        $categories->fill($this->otherModelData);

        $categories->save();
        $this->clear();
    }

    public function clear(){
        $this->name='';
        $this->subCategory = null;
        $this->otherModelData = [];
    }

    public function edit($id){
        $categories = CategoryProduct::find($id);
        $this->clear();
        $this->Id = $categories->id;
        $this->name = $categories->name;
    }

    public function update($id){
        $categories = CategoryProduct::find($id);
        $categories->name = $this->name;
        $categories->save();
        $this->clear();
    }
    
    public function delete($id){
        $categories = CategoryProduct::find($id);
        $categories->delete();
        $this->clear();
    }
}
