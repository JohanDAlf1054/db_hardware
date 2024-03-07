<?php

namespace App\Livewire;

use App\Models\SubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class SubCategoryComponent extends Component
{
    use WithPagination;
    public $search='';
    public $Id, $name, $description;

    public function render()
    {
        
        //    $units = SubCategory::where('name','like', '%'.$this->search.'%')->paginate(5);
        // return view('sub-category.index', compact('units'));
        $subCats = SubCategory::where('name','like', '%'.$this->search.'%')->paginate(5);
        return view('livewire.sub-category-component', compact('subCats'));
 
    }

    public function store(){
        $subCat = New SubCategory();
        $subCat->name = $this -> name;
        $subCat->description = $this -> description;
        $subCat->save();
        $this->clear();
    }

    public function clear(){
        $this->name='';
        $this->description='';
    }

    public function edit($id){
        $subCat = SubCategory::find($id);
        $this->clear();
        $this->Id = $subCat->id;
        $this->name = $subCat->name;
        $this->description = $subCat->description;
    }

    public function update($id){
        $subCat = SubCategory::find($id);
        $subCat->name = $this->name;
        $subCat->description = $this->description;
        $subCat->save();
        $this->clear();
    }
    
    public function delete($id){
        $subCat = SubCategory::find($id);
        $subCat->delete();
        $this->clear();
    }
}
