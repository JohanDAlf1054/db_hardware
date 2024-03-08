<?php

namespace App\Livewire;

use App\Models\SubCategory;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class SubCategoryComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $search='';
    public $Id, $name, $description;

    protected $rules = [
        'name' => 'required|max:50',
        'description' => 'required|max:50'
    ];

    public function render()
    {
        
        //    $units = SubCategory::where('name','like', '%'.$this->search.'%')->paginate(5);
        // return view('sub-category.index', compact('units'));
        $subCats = SubCategory::where('name','like', '%'.$this->search.'%')->paginate(5);
        return view('livewire.sub-category-component', compact('subCats'));
 
    }

    public function store(){
        $this->validate([
            'description' => 'required|max:50',
            'name' => 'required|max:50'
        ],[
            'description.required' => 'La descripcion es requerida',
            'name.required' => 'El nombre es requerido'
        ]);

        $subCat = New SubCategory();
        $subCat->name = $this -> name;
        $subCat->description = $this -> description;
        $subCat->save();
        $this->clear();
        $this->flash('success', 'Sub Categoria Creada');
        return redirect()->to('categorySub');
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
        $this->validate([
            'description' => 'required|max:50',
            'name' => 'required|max:50'
        ],[
            'description.required' => 'La descripcion es requerida',
            'name.required' => 'El nombre es requerido'
        ]);
        $subCat = SubCategory::find($id);
        $subCat->name = $this->name;
        $subCat->description = $this->description;
        $subCat->save();
        $this->clear();
        $this->flash('success', 'Sub Categoria Modificada');
        return redirect()->to('categorySub');
    }
    
    public function delete($id){
        $subCat = SubCategory::find($id);
        $subCat->delete();
        $this->clear();
    }
}
