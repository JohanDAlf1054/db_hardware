<?php

namespace App\Livewire;

use App\Models\CategoryProduct;
use Illuminate\Support\Facades\Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriesComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $search='';
    public $Id, $name, $description;

    public function render()
    {   
        $categories = CategoryProduct::where('name','like', '%'.$this->search.'%')->paginate(5);
        return view('livewire.categories-component', compact('categories'));
    }

    public function store(){
        $this->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:50'
        ],[
            'name.required' => 'El nombre es requerido',
            'description.required' => 'La descripción es requerida'
        ]);
        $categories = New CategoryProduct();
        $categories->name = $this -> name;
        $categories->description = $this -> description;
        $categories->save();
        $this->clear();
        $this->flash('success', 'Categoria Creada');
        return redirect()->to('category');
    }

    public function clear(){
        $this->name='';
        $this->description='';
    }

    public function show($id){
        Session::put("category_id", $id);
        return redirect()->route('categorySub.index');
    }

    public function edit($id){
        $categories = CategoryProduct::find($id);
        $this->clear();
        $this->Id = $categories->id;
        $this->name = $categories->name;
        $this->description = $categories->description;
    }

    public function update($id){
        $this->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:50'
        ],[
            'name.required' => 'El nombre es requerido',
            'description.required' => 'La descripción es requerida'
        ]);
        $categories = CategoryProduct::find($id);
        $categories->name = $this->name;
        $categories->description = $this->description;
        $categories->save();
        $this->clear();
        $this->flash('success', 'Categoria Modificada');
        return redirect()->to('category');
    }
    
    public function delete($id){
        $categories = CategoryProduct::find($id);
        $categories->delete();
        $this->clear();
    }
}
